<?php

require_once 'enviar_mail.php';
include_once 'conexion_bd.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['mail'];
$password = $_POST['password'];
$id_cuota = $_POST['cuota'];

if (isset($_POST['actividades'])) {
    $actividades = $_POST['actividades'];
}

$actividadesInscritas = "";

$consulta_cuotas = "SELECT * FROM cuota WHERE id_cuota=" . $id_cuota;
$resultado_cuotas = conexionBD($consulta_cuotas);
if ($resultado_cuotas) {
    $fila_cuota = mysql_fetch_array($resultado_cuotas);
    switch ($fila_cuota['nombre_cuota']) {
        case "Profesor":
        case "Estudiante":
            $universidad = ' de ' . $_POST['universidad'];
            break;
        default:
            $universidad = "";
            break;
    }
    $precio = $fila_cuota['importe'];

    $insertar_usuario = "INSERT INTO usuario (nombre, apellidos, centro_trabajo, telefono, mail, password, cuota_inscripcion, tipo_usuario) VALUES "
            . "('" . $nombre . "', '" . $apellidos . "', '" . $universidad . "', '" . $telefono . "', '" . $email . "', "
            . "'" . $password . "', " . $id_cuota . ", 'Congresista')";

    $resultado_insert = conexionBD($insertar_usuario);
    if (!$resultado_insert) {
        salir("Ya existe un usuario registrado con esa dirección de correo.", -1);
    }
    $id_usuario = mysql_insert_id();

    if (!empty($actividades)) {
        $consulta_actividades = "SELECT * FROM actividad WHERE id_actividad NOT IN "
                . "(SELECT id_actividad FROM cuota_tiene_actividad WHERE id_cuota=" . $id_cuota . ")";

        $resultado_actividades = conexionBD($consulta_actividades);
        if ($resultado_actividades) {
            if (mysql_num_rows($resultado_actividades) > 0) {
                $actividadesInscritas = 'Además, has reservado plaza en las siguientes actividades: <br/><br/>';
                $insertar_actividades_elegidas = "INSERT INTO usuario_tiene_actividad VALUES ";
                $actividades_extras = 0;
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
                if($actividades_extras > 0){
                    $resultado_insert_actividades = conexionBD($insertar_actividades_elegidas);
                    if(!$resultado_insert_actividades){
                        salir("No se han podido registrar las actividades. Pongase en contacto con la dirección del congreso.", -1);
                    }
                }
            }
            $consulta_actividades = "SELECT nombre_actividad FROM actividad, cuota_tiene_actividad WHERE "
                    . "actividad.id_actividad=cuota_tiene_actividad.id_actividad AND id_cuota=" . $id_cuota;

            $resultado_actividades = conexionBD($consulta_actividades);
            if ($resultado_actividades) {
                if (mysql_num_rows($resultado_actividades) > 0) {
                    while ($fila_actividades = mysql_fetch_array($resultado_actividades)) {
                        $actividadesInscritas = $actividadesInscritas . "     - " . $fila_actividades['nombre_actividad'] . ".<br/>";
                    }
                }

                $asunto = '[Mensaje de Web] Inscripción al congreso';
                $mensaje = 'Se ha inscrito al congreso en la categoria de '
                        . $fila_cuota['nombre_cuota'] . $universidad . '.<br/><br/>' . $actividadesInscritas
                        . '<br/> El precio total es de: ' . $precio . '€<br/><br/>'
                        . 'La forma de pago consiste en realizar una trasferencia indicando su nombre de usuario al siguiente 
                        número de cuenta: <br/><br/> 2100 4323 54 2516300484 <br/><br/> Tras realizar la transferencia debe enviar a "congresosCEIIE@gmail.com"
                        un justificante de dicho pago con el asunto "Confirmación pago ' . $apellidos . ', ' . $nombre . '".<br/><br/>'
                        . '¡Nos vemos pronto!';

                if (enviarMail($email, $asunto, $mensaje)) {
                    $asunto = '[Mensaje de Web] Inscripción de usuario';
                    $mensaje = $nombre . ' ' . $apellidos . ' se ha inscrito al congreso en la categoria de '
                            . $fila_cuota['nombre_cuota'] . $universidad . '.<br/><br/>' . $actividadesInscritas
                            . '<br/> El precio total es de: ' . $precio . '€<br/><br/>';

                    enviarMail('congresoCEIIE@gmail.com', $asunto, $mensaje);
                    echo "<script>
                        alert('Se ha inscrito correctamente.');
                        location.href='../index.php?seccion=inscribete';
                    </script>";
                } else {
                    echo "<script>
                        alert('Lo sentimos, ha ocurrido un error durante la inscripción. \n Intentelo más tarde.');
                        location.href='../index.php?seccion=inscribete';
                    </script>";
                }
            }
        }
    }
}

function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='../index.php?seccion=inscribete';
        </script>";
    exit($code);
}
?>