<?php

include_once 'conexion_bd.php';
session_start();

if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "Administrador") {
$consulta = "UPDATE cuota SET nombre_cuota='" . $_POST['nombre_cuota']
        . "', descripcion='" . $_POST['descripcion']  
        . "' WHERE id_cuota=" . $_POST['id'];
    $resultado = conexionBD($consulta);
    if ($resultado) {
         echo '<script>
            alert("Se ha modificado la cuota con éxito.");
            location.href= "../index.php?seccion=cuotas";
        </script>';
    } else {
            echo '<script>
            alert("Error al modificar la cuota.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
    }
}
?>