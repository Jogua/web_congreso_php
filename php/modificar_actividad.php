<?php

include_once 'conexion_bd.php';
session_start();

if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "Administrador") {
$consulta = "UPDATE actividad SET nombre_actividad='" . $_POST['nombre_actividad']
        . "', fecha_hora='" . str_replace("T", " ", $_POST['fecha_hora'])
        . "', descripcion='" . $_POST['descripcion']  
        . "' WHERE id_actividad=" . $_POST['id'];
    $resultado = conexionBD($consulta);
    if ($resultado) {
         echo '<script>
            alert("Se ha modificado la actividad con éxito.");
            location.href= "../index.php?seccion=detalle_visita&visita=' . $_POST['id'] . '";
        </script>';
    } else {
            echo '<script>
            alert("Error al modificar la actividad.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
    }
}
?>