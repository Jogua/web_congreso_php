<?php

include_once 'conexion_bd.php';
session_start();

$consulta = 'SELECT * FROM usuario WHERE mail="' . $_POST['email'] . '" AND password="' . $_POST['password'] . '"';

//Envio la consulta a MySQL.
$resultado = conexionBD($consulta);

if (mysql_num_rows($resultado) == 0) {
    if (isset($_GET['error'])) {
        header('Location:' . $_SERVER['HTTP_REFERER']);
    } else {
        if (strpos($_SERVER['HTTP_REFERER'], '?') != false) {
            header('Location:' . $_SERVER['HTTP_REFERER'] . '&error=1');
        }else{
            header('Location:' . $_SERVER['HTTP_REFERER'] . '?error=1');
        }
    }
} else {
    $fila = mysql_fetch_array($resultado);
    $_SESSION['mail'] = $fila['mail'];
    $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
?>

