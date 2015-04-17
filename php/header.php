<?php

function destacar($seccion, $sec) {
    if ($seccion == $sec) {
        echo '<li id="active">';
    } else {
        echo '<li>';
    }
}
?>

<ul id="navlist">
    <?php
    destacar($seccion, "presentacion");
    ?>
    <a href="index.php?seccion=presentacion">Inicio</a>
</li>
<?php
destacar($seccion, "inscribete");
?>
<a href="index.php?seccion=inscribete">Inscríbete</a>
</li>
<li>
<a href="index.php?seccion=actividades">Actividades</a> 
<ul>
    <li> <a href="index.php?seccion=detalle_visita&visita=alhambra">Visita Alhambra</a> </li>
    <li> <a href="index.php?seccion=detalle_visita&visita=sierra">Visita Sierra Nevada</a> </li>
</ul>
</li>
    
<li> <a href="index.php?seccion=ponencias">Ponencias</a> </li>

</li>
<?php
destacar($seccion, "sobre_granada");
?>
<a href="index.php?seccion=sobre_granada">Sobre Granada</a>
<ul>
    <li> <a href="index.php?seccion=que_visitar">Qué visitar </a> </li>
    <li> <a href="index.php?seccion=etsiit">ETSIIT </a> </li>
</ul>
</li>
<?php
destacar($seccion, "como_llegar");
?>
<a href="index.php?seccion=como_llegar">Como llegar</a>
<ul>
    <li> <a href="index.php?seccion=localizacion#autobus">Autobús</a> </li>
    <li> <a href="index.php?seccion=localizacion#renfe">Tren</a> </li>
    <li> <a href="index.php?seccion=localizacion#aeropuerto">Avión</a> </li>
</ul>
</li>
<li>
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


<?php
//$nombre_archivo = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
//echo "Parametro es :" . $nombre_archivo . "<br />";
//$url_actual = $_SERVER["REQUEST_URI"];
//
//echo "<b>$url_actual</b>";
?>
