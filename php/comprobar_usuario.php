<?php
include './conexion_bd.php';
session_start();

$consulta = 'SELECT * FROM usuario, tipo_usuario WHERE mail="' . $_POST['email'] . '" AND password="' . $_POST['password'] . '" AND usuario.id_tipo_usuario=tipo_usuario.id_tipo_usuario';

//Envio la consulta a MySQL.
$resultado = conexionBD($consulta);

if (mysql_num_rows ($resultado) == 0) {
    header('Location:' . $_SERVER['HTTP_REFERER'] . '&error_inicio_sesion=1');
} else {
    $fila = mysql_fetch_array ($resultado);
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['mail'] = $fila['mail'];
    $_SESSION['tipo_usuario'] = $fila['nombre_tipo'];
    header('Location:' . $_SERVER['HTTP_REFERER']);
}

?>

