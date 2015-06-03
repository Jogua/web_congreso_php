<?php

include_once 'conexion_bd.php';

if (isset($_GET['cuota'])) {
    $consulta_actividades = "SELECT importe FROM cuota WHERE id_cuota=" . $_GET['cuota'];
    $resultado_actividades = conexionBD($consulta_actividades);

    if ($resultado_actividades) {
        $fila = mysql_fetch_array($resultado_actividades);
        if ($fila) {
            echo $fila['importe'];
        }
    }
}else if (isset($_GET['actividad'])) {
    $consulta_actividades = "SELECT importe FROM actividad WHERE id_actividad=" . $_GET['actividad'];
    $resultado_actividades = conexionBD($consulta_actividades);

    if ($resultado_actividades) {
        $fila = mysql_fetch_array($resultado_actividades);
        if ($fila) {
            echo $fila['importe'];
        }
    }
}