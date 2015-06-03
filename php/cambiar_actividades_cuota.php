<?php

include_once 'conexion_bd.php';

$consulta_actividades = "SELECT id_actividad, nombre_actividad, url_foto, importe FROM actividad";
$resultado_actividades = conexionBD($consulta_actividades);
echo '<br>';
if ($resultado_actividades) {

    $consulta_actividades_incluidas = "SELECT id_actividad FROM cuota_tiene_actividad WHERE id_cuota=" . $_GET['id'];
    $resultado_actividades_incluidas = conexionBD($consulta_actividades_incluidas);
    if ($resultado_actividades_incluidas) {

        $actividades_incluidas = [];
        while ($fila = mysql_fetch_array($resultado_actividades_incluidas)) {
            array_push($actividades_incluidas, $fila['id_actividad']);
        }

        while ($fila = mysql_fetch_array($resultado_actividades)) {
            echo '<li>';
            $esta = in_array($fila['id_actividad'], $actividades_incluidas);
            if ($esta) {
                echo '<input id="act_' . $fila['id_actividad'] . '" type="checkbox" name="actividades[]" value=' . $fila['id_actividad'] . ' onchange="activar_foto(' . $fila['id_actividad'] . ');" checked disabled/>';
            } else {
                echo '<input id="act_' . $fila['id_actividad'] . '" type="checkbox" name="actividades[]" value=' . $fila['id_actividad'] . ' onchange="activar_foto(' . $fila['id_actividad'] . ');" />';
            }
            echo '<label for="act_' . $fila['id_actividad'] . '"> ' . $fila['nombre_actividad'] . " (" . $fila['importe'] . " €)" . '</label>';
            if($esta){
                echo '<br><br>';
                echo '<img class="borde_blanco imagen_actividad_peque" src="' . $fila['url_foto'] . '" alt="Foto actividad" />'; 
            }else{
                echo '<div id="foto_actividad_' . $fila['id_actividad'] . '" hidden></div>';
            }
            echo '</li>';
        }
    }
}