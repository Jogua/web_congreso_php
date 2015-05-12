<?php

include './conexion_bd.php';

session_start();
//comprobación de que el usuario exista
$consulta = 'INSERT INTO usuario (nombre, apellidos, telefono, mail, password, tipo_usuario) VALUES '
        . '("' . $_POST['nombre'] . '", "' . $_POST['apellidos'] . '", "' . $_POST['telefono'] . '", "' . $_POST['email'] . '", "' . $_POST['password'] . '", "' . $_POST['tipo_usuario'] . '")';

//Envio la consulta a MySQL.
$resultado = conexionBD($consulta);

if (!$resultado) {
    echo '<script>
            alert("El usuario ya existe.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
} else {
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['tipo_usuario'] = $_POST['tipo_usuario'];
    echo '<script>
            alert("El usuario se ha creado correctamente.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
}
?>