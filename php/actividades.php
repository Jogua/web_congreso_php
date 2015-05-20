<h2>Actividades</h2>
<p>
    Recuerda que las actividades tendrán un número de plazas limitadas, por lo que 
    debes apuntarte en el momento de la <a href="index.php?seccion=inscribete">inscripción</a>.
</p>
<p>
    A continuación se muestra una lista de las actividades propuestas:
</p>
<ul>
    <?php
        $consulta_actividades = "SELECT id_actividad, nombre_actividad FROM actividad";
        $resultado_actividades = conexionBD($consulta_actividades);
        
        if($resultado_actividades){
            while ($fila = mysql_fetch_array($resultado_actividades)) {
                echo '<li> <a href="index.php?seccion=detalle_visita&visita=' . $fila['id_actividad'] . '">'
                        . $fila['nombre_actividad'] . '</a> </li>';
            }
        }
    ?>
</ul>