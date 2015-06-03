<?php

require_once 'enviar_mail.php';
include_once 'conexion_bd.php';

session_start();

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$id_cuota = $_POST['cuota'];

if (isset($_POST['actividades'])) {
    $actividades = $_POST['actividades'];
}

if (isset($_POST['hotel'])) {
    $quiere_hotel = true;
} else {
    $quiere_hotel = false;
}

$actividadesInscritas = "";

$consulta_cuotas = "SELECT * FROM cuota WHERE id_cuota=" . $id_cuota;
$resultado_cuotas = conexionBD($consulta_cuotas);
if ($resultado_cuotas) {

    $fila_cuota = mysql_fetch_array($resultado_cuotas);
    
    $precio = $fila_cuota['importe'];

    $insertar_usuario = "INSERT INTO usuario (nombre, apellidos, telefono, mail, password, cuota_inscripcion, tipo_usuario) VALUES "
            . "('" . $nombre . "', '" . $apellidos . "', '" . $telefono . "', '" . $mail . "', "
            . "'" . $password . "', " . $id_cuota . ", 'Congresista')";

    $resultado_insert = conexionBD($insertar_usuario);
    if (!$resultado_insert) {
        salir("Ya existe un usuario registrado con esa dirección de correo.", -1);
    }
    $consulta_id_usuario = "SELECT id_usuario FROM usuario WHERE mail='" . $mail . "'";
    $resultado_id_usuario = conexionBD($consulta_id_usuario);
    if (!$resultado_id_usuario) {
        salir("Ha ocurrido un error.", -1);
    }
    $fila_id_usuario = mysql_fetch_array($resultado_id_usuario);
    $id_usuario = $fila_id_usuario['id_usuario'];

    if (!empty($actividades)) {
        $consulta_actividades = "SELECT * FROM actividad WHERE id_actividad NOT IN "
                . "(SELECT id_actividad FROM cuota_tiene_actividad WHERE id_cuota=" . $id_cuota . ")";

        $resultado_actividades = conexionBD($consulta_actividades);
        if ($resultado_actividades) {
            if (mysql_num_rows($resultado_actividades) > 0) {
                $actividadesInscritas = 'Ha confirmado su plaza en las siguientes actividades: <br/><br/>';
                $insertar_actividades_elegidas = "INSERT INTO usuario_tiene_actividad VALUES ";
                $actividades_extras = 0;
                //Aqui se definen las actividades que te has inscrito pero que no pertenecen a tu cuota
                while ($fila_actividades = mysql_fetch_array($resultado_actividades)) {
                    if (in_array("act_" + $fila_actividades['id_actividad'], $actividades)) {
                        $actividadesInscritas = $actividadesInscritas . "     - " . $fila_actividades['nombre_actividad'] . ".<br/>";
                        $precio += $fila_actividades['importe'];
                        if ($actividades_extras == 0) {
                            $insertar_actividades_elegidas = $insertar_actividades_elegidas . " (" . $id_usuario . ", " . $fila_actividades['id_actividad'] . ") ";
                        } else {
                            $insertar_actividades_elegidas = $insertar_actividades_elegidas . ", (" . $id_usuario . ", " . $fila_actividades['id_actividad'] . ") ";
                        }
                        $actividades_extras++;
                    }
                }
                if ($actividades_extras > 0) {
                    $resultado_insert_actividades = conexionBD($insertar_actividades_elegidas);
                    if (!$resultado_insert_actividades) {
                        salir("No se han podido registrar las actividades. Pongase en contacto con la dirección del congreso.", -1);
                    }
                }
            }
            $consulta_actividades = "SELECT nombre_actividad FROM actividad, cuota_tiene_actividad WHERE "
                    . "actividad.id_actividad=cuota_tiene_actividad.id_actividad AND id_cuota=" . $id_cuota;

            $resultado_actividades = conexionBD($consulta_actividades);
            if ($resultado_actividades) {
                if (mysql_num_rows($resultado_actividades) > 0) {
                    //Aqui se definen las actividades que pertenecen a tu cuota.
                    while ($fila_actividades = mysql_fetch_array($resultado_actividades)) {
                        $actividadesInscritas = $actividadesInscritas . "     - " . $fila_actividades['nombre_actividad'] . ".<br/>";
                    }
                }
            }
        }
    }

    iniciarSesion($mail);

    if (!$quiere_hotel) {
        enviarMailInscripcion($id_usuario, $nombre, $apellidos, $mail, $fila_cuota['nombre_cuota'], $actividadesInscritas, "", $precio);
        echo "<script>
            alert('Se ha inscrito correctamente.');
            location.href='../index.php?seccion=inscribete';
        </script>";
    } else {
        $tipo_hab = $_POST["habitacion"];
        $hotel = $_POST["hotel_" . $tipo_hab];
        $precio_hotel = $_POST["precio_" . $tipo_hab];
        $precio += $precio_hotel;
        if (reservarHabitacion($hotel, $tipo_hab, $precio_hotel, $mail, $nombre_hotel, $nombre_habitacion)) {
            $datos_hotel = "<br>Tiene reservada 1 Habitación para las fechas 01-06-2015 al 03-06-2015, con las siguientes características:<br>"
                    . "Nombre del hotel: " . $nombre_hotel . "<br>Tipo de habitación: " . $nombre_habitacion . "<br>";
            enviarMailInscripcion($id_usuario, $nombre, $apellidos, $mail, $fila_cuota['nombre_cuota'], $actividadesInscritas, $datos_hotel, $precio);
            echo "<script type='text/javascript'>
                alert('Su reserva se ha realizado correctamente.');
                location.href='../index.php';
            </script>";
        }else{
            echo "<script type='text/javascript'>
                alert('No se ha podido reservar la habiación.');
                location.href='../index.php?seccion=ficha_inscripcion';
            </script>";
        }
    }
}

function iniciarSesion($mail) {
    $_SESSION['mail'] = $mail;
    $_SESSION['tipo_usuario'] = "Congresista";
}

function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='../index.php?seccion=inscribete';
        </script>";
    exit($code);
}

function enviarMailInscripcion($id_usuario, $nombre, $apellidos, $mail, $nombre_cuota, $actividadesInscritas, $datos_hotel, $precio) {
    $asunto = '[Mensaje de Web] Inscripción al congreso';
    $mensaje = 'Se ha inscrito al congreso en la categoria de '
            . $nombre_cuota . '.<br/><br/>' . $actividadesInscritas
            . $datos_hotel . '<br/> El precio total es de: ' . $precio . '€<br/><br/>'
            . 'La forma de pago consiste en realizar una transferencia indicando su nombre de usuario al siguiente 
            número de cuenta: <br/><br/> 2100 4323 54 2516300484 <br/><br/> Tras realizar la transferencia debe enviar a 
            "congresosCEIIE@gmail.com" un justificante de dicho pago con el asunto "Confirmación pago #' . $id_usuario
            . '".<br/><br/>¡Nos vemos pronto!';

    if (enviarMail($mail, $asunto, $mensaje)) {
        $asunto = '[Mensaje de Web] Inscripción de usuario';
        $mensaje = $nombre . ' ' . $apellidos . ' con dirección de correo: <strong>' . $mail . '</strong> '
                . 'se ha inscrito al congreso en la categoria de '
                . $nombre_cuota . '.<br/><br/>' . $actividadesInscritas
                . $datos_hotel . '<br/> El precio total es de: ' . $precio . '€<br/><br/>';

        enviarMail('congresoCEIIE@gmail.com', $asunto, $mensaje);
        return true;
    } else {
        return false;
    }
}

function reservarHabitacion($hotel, $tipo_hab, $precio, $mail, &$nombre_hotel, &$nombre_habitacion) {

    $url = "localhost/GranaHome_php/reserva/f_inicio/20150601/f_fin/20150603/hotel/" . $hotel . "/hab/" . $tipo_hab . "/num/1";
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
        if (!$resultado_usuario) {
            salir("Error de conexión", -3);
        }
        $fila_usuario = mysql_fetch_array($resultado_usuario);
        $id_usuario = $fila_usuario['id_usuario'];

        $insertar_reserva = "INSERT INTO usuario_reserva_hotel VALUES (" . $id_usuario . ", '"
                . $decode->nombre_hotel . "', '" . $decode->nombre_habitacion . "', "
                . "'2015-06-01', '2015-06-03', 1, " . $precio . ")";
        $resultado_insertar_reserva = conexionBD($insertar_reserva);

        $nombre_hotel = $decode->nombre_hotel;
        $nombre_habitacion = $decode->nombre_habitacion;

        if (!$resultado_insertar_reserva) {
            salir("Error de conexión", -3);
        }
        return true;
    } else {
        return false;
    }
}

?>