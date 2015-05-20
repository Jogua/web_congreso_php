<?php
include_once 'conexion_bd.php';

function destacar($activo) {
    if ($activo) {
        echo '<li id="active">';
    } else {
        echo '<li>';
    }
}
?>

<ul id="navlist">
    <?php
    destacar($seccion == "presentacion");
    ?>
    <a href="index.php?seccion=presentacion">Inicio</a>
</li>
<?php
destacar($seccion == "inscribete");
?>
<a href="index.php?seccion=inscribete">Inscríbete</a>
</li>
<?php
destacar($seccion == "actividades" || $seccion == "detalle_visita");
?>
<a href="index.php?seccion=actividades">Actividades</a> 
<ul>
    <?php
        $consulta_actividades = "SELECT id_actividad, nombre_actividad FROM actividad";
        $resultado_actividades = conexionBD($consulta_actividades);
        
        if($resultado_actividades){
            while ($fila = mysql_fetch_array($resultado_actividades)) {
                echo '<li> <a href="index.php?seccion=detalle_visita&visita=' . $fila['id_actividad'] . '">' . $fila['nombre_actividad'] . '</a> </li>';
            }
        }
    ?>
<!--    <li> <a href="index.php?seccion=detalle_visita&visita=alhambra">Visita Alhambra</a> </li>
    <li> <a href="index.php?seccion=detalle_visita&visita=sierra">Visita Sierra Nevada</a> </li>-->
</ul>
</li>

<?php
destacar($seccion == "ponencias");
?>
<a href="index.php?seccion=ponencias">Ponencias</a>
</li>

<?php
destacar($seccion == "sobre_granada" || $seccion == "que_visitar" || $seccion == "etsiit");
?>
<a href="index.php?seccion=sobre_granada">Sobre Granada</a>
<ul>
    <li> <a href="index.php?seccion=que_visitar">Qué visitar </a> </li>
    <li> <a href="index.php?seccion=etsiit">ETSIIT </a> </li>
</ul>
</li>

<?php
destacar($seccion == "como_llegar" || $seccion == "localizacion");
?>
<a href="index.php?seccion=como_llegar">Como llegar</a>
<ul>
    <li> <a href="index.php?seccion=localizacion#autobus">Autobús</a> </li>
    <li> <a href="index.php?seccion=localizacion#renfe">Tren</a> </li>
    <li> <a href="index.php?seccion=localizacion#aeropuerto">Avión</a> </li>
</ul>
</li>


<?php
destacar($seccion == "patrocinio" || $seccion == "acerca_de" || $seccion == "contacto")
?>
<a>Más información</a>
<ul>
    <li>
        <a href="index.php?seccion=patrocinio">Patrocinio</a>
    </li>
    <li><a href="index.php?seccion=acerca_de">Acerca de</a>
    </li>
    <li><a href="index.php?seccion=contacto">Contacto</a>
    </li>
</ul>
</li>