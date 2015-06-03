<?php

include_once 'conexion_bd.php';

$consulta_actividades = "SELECT url_foto FROM actividad WHERE id_actividad=" . $_GET['id'];
$resultado_actividades = conexionBD($consulta_actividades);

if ($resultado_actividades) {
    $fila = mysql_fetch_array($resultado_actividades);
    if ($fila) {
        echo '<br><br>';
        echo '<img class="borde_blanco imagen_actividad_peque" src="' . $fila['url_foto'] . '" alt="Foto actividad" />';
    }
}