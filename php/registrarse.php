<?php

include './conexion_bd.php';

session_start();

//comprobación de que el usuario exista
$consulta = 'INSERT INTO usuario (nombre, apellidos, telefono, mail, password, id_tipo_usuario) VALUES '
        . '("' . $_POST['nombre'] . '", "' . $_POST['apellidos'] . '", "' . $_POST['telefono'] . '", "' . $_POST['mail'] . '", "' . $_POST['password'] . '", "' . $_POST['tipo_usuario'] . '")';

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

    //hago consulta para sacar el nombre del tipo de usuario registrado
    $consulta = 'SELECT nombre_tipo FROM tipo_usuario WHERE id_tipo_usuario=' . $_POST['tipo_usuario'];

    //Envio la consulta a MySQL.
    $resultado = conexionBD($consulta);

    if (!$resultado) {
            echo '<script>
            alert("Error al consultar el tipo de usuario.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
    } else {
        $fila = mysql_fetch_array($resultado);

        $_SESSION['tipo_usuario'] = $fila['nombre_tipo'];
        echo '<script>
            alert("El usuario se ha creado correctamente.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
    }
}
?>