<?php

include 'conexion_bd.php';
require_once 'enviar_mail.php';
session_start();
//comprobación de que el usuario exista
$consulta = 'SELECT * FROM usuario WHERE mail="' . $_POST['email'] . '"';

//Envio la consulta a MySQL.
$resultado = conexionBD($consulta);

if (mysql_num_rows($resultado) == 0) {
    header('Location:' . $_SERVER['HTTP_REFERER'] . '#usuario_no_encontrado');
} else {
    $fila = mysql_fetch_array($resultado);
    $mensaje = "Le recordamos que su contraseña de acceso a la página web del "
            . "Congreso de Estudiantes de Ingeniería Informática en España es: <br><br>" . $fila['password']
            . "<br><br>Un saludo.";

    enviarMail($fila['mail'], "[CEIIE] Recordatorio de contraseña", $mensaje);
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '#usuario_encontrado');
}
?>