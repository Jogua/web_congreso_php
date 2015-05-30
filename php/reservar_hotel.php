<?php

include_once 'conexion_bd.php';

session_start();

if (isset($_SESSION['mail'])) {
    $mail = $_SESSION['mail'];
} else {
    salir("Es necesario que estes inscrito para poder reservar un hotel", -3);
}

if (isset($_POST['hotel'])) {
    $hotel = $_POST['hotel'];
} else {
    salir('Falta el hotel.', -2);
}
if (isset($_POST['ini'])) {
    $fecha_entrada = $_POST['ini'];
} else {
    salir('Falta fecha de entrada.', -2);
}
if (isset($_POST['fin'])) {
    $fecha_salida = $_POST['fin'];
} else {
    salir('Falta fecha de salida.', -2);
}
if (isset($_POST['hab'])) {
    $tipo_hab = $_POST['hab'];
} else {
    salir('Falta el típo de habitación.', -2);
}
if (isset($_POST['num'])) {
    $n_habitaciones = $_POST['num'];
} else {
    salir('Falta número de habitaciones.', -2);
}
if (isset($_POST['precio'])) {
    $precio = $_POST['precio'];
} else {
    salir('Falta el precio total.', -2);
}

$fecha_entrada_url = str_replace("-", "", $fecha_entrada);
$fecha_salida_url = str_replace("-", "", $fecha_salida);

$url = "localhost/GranaHome_php/reserva/f_inicio/" . $fecha_entrada_url . "/f_fin/" . $fecha_salida_url . "/hotel/" . $hotel . "/hab/" . $tipo_hab . "/num/" . $n_habitaciones;
$parametros_post = "usuario=" . $mail;

$sesion = curl_init($url);
// definir tipo de petición a realizar: POST
curl_setopt($sesion, CURLOPT_POST, true);
// Le pasamos los parámetros definidos anteriormente
curl_setopt($sesion, CURLOPT_POSTFIELDS, $parametros_post);
// sólo queremos que nos devuelva la respuesta
curl_setopt($sesion, CURLOPT_HEADER, false);
curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
// ejecutamos la petición
$respuesta = curl_exec($sesion);
// cerramos conexión
curl_close($sesion);

$decode = json_decode($respuesta);

if ($decode->exito) {
    $consulta_usuario = "SELECT id_usuario FROM usuario WHERE mail='" . $mail . "'";
    $resultado_usuario = conexionBD($consulta_usuario);
    if(!$resultado_usuario){
        salir("Error de conexión", -3);
    }
    $fila_usuario = mysql_fetch_array($resultado_usuario);
    $id_usuario = $fila_usuario['id_usuario'];
    
    $insertar_reserva = "INSERT INTO usuario_reserva_hotel VALUES (" . $id_usuario . ", '"
            . $decode->nombre_hotel . "', '" . $decode->nombre_habitacion . "', '"
            . $fecha_entrada . "', '" . $fecha_salida . "', " . $n_habitaciones . ", " . $precio . ")";
    $resultado_insertar_reserva = conexionBD($insertar_reserva);
    
    if(!$resultado_insertar_reserva){
        salir("Error de conexión", -3);
    }
    
    echo "<script type='text/javascript'>
            alert('Su reserva se ha realizado correctamente.');
            location.href='../index.php';
        </script>";
} else {
    echo "<script type='text/javascript'>
            alert('No se ha podido reservar la habiación.');
            location.href='../index.php?seccion=ficha_inscripcion';
        </script>";
}

function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='../index.php?seccion=ficha_inscripcion';
        </script>";
    exit($code);
}

?>