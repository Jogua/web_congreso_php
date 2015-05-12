<?php

include 'conexion_bd.php';
include 'enviar_mail.php';
session_start();
//comprobación de que el password existente era correcto
$consulta = 'SELECT password,mail FROM usuario WHERE password="' . $_POST['password_actual'] . '"';

//Envio la consulta a MySQL.
$resultado = conexionBD($consulta);

if (mysql_num_rows($resultado) == 0) {
    header('Location:' . $_SERVER['HTTP_REFERER'] . '#password_incorrecto');
} else {
    $fila = mysql_fetch_array($resultado);

    $mensaje = "La nueva contraseña de acceso a la página web del "
            . "Congreso de Estudiantes de Ingeniería Informática en España es: <br><br>" . $_POST['contrasena'] . "<br><br>Un saludo.";

    enviarMail($fila['mail'], "[CEIIE] Cambio de contraseña", $mensaje);

    $update = 'UPDATE usuario SET password="' . $_POST['contrasena'] . '" WHERE password="' . $_POST['password_actual'] . '"';
    $resultado = conexionBD($update);

    header('Location: ' . $_SERVER['HTTP_REFERER'] . '#password_correcto');
}
?>