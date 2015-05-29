<?php

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

//echo "<br>";
//
//echo $fecha_entrada;
//echo "<br>";
//echo $fecha_salida;
//echo "<br>";
//echo $hotel;
//echo "<br>";
//echo $tipo_hab;
//echo "<br>";
//echo $n_habitaciones;
//echo "<br>";

$url = "localhost/GranaHome_php/reserva/f_inicio/" . $fecha_entrada . "/f_fin/" . $fecha_salida . "/hotel/" . $hotel . "/hab/" . $tipo_hab . "/num/" . $n_habitaciones;
$parametros_post = "usuario=j@2.es";// . $mail;

$sesion = curl_init($url);
// definir tipo de petición a realizar: POST
curl_setopt($sesion, CURLOPT_POST, true);
// Le pasamos los parámetros definidos anteriormente
curl_setopt ($sesion, CURLOPT_POSTFIELDS, $parametros_post); 
// sólo queremos que nos devuelva la respuesta
curl_setopt($sesion, CURLOPT_HEADER, false); 
curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
// ejecutamos la petición
$respuesta = curl_exec($sesion);
// cerramos conexión
curl_close($sesion);

$decode = json_decode($respuesta);

if($decode->exito){
    echo "<script type='text/javascript'>
            alert('Su reserva se ha realizado correctamente.');
            location.href='../index.php';
        </script>";
}else{
    echo "<script type='text/javascript'>
            alert('La habitación no se ha podido reservar.');
            location.href='../index.php?seccion=inscribete';
        </script>";
}


function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='index.php?seccion=inscribete';
        </script>";
    exit($code);
}
?>