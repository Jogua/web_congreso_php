<ul id="navlist">
    <?php
        if ($_SERVER["REQUEST_URI"] == "/web_congreso_php/index.php?seccion=presentacion") {
            echo '<li id="active">';
        } else {
            echo '<li>';
        }
    ?>
        
        <a href="index.php?seccion=presentacion">Inicio</a>
    </li>
    <li><a href="index.php?seccion=inscribete">Inscríbete</a>
    </li>
    <li><a>Programa</a>
        <ul>
            <li> <a href="index.php?seccion=actividades">Actividades</a> </li>
            <li> <a href="index.php?seccion=ponencias">Ponencias</a> </li>
        </ul>
    </li>
    <li><a href="index.php?seccion=sobre_granada">Sobre Granada</a>
        <ul>
            <li> <a href="index.php?seccion=que_visitar">Qué visitar </a> </li>
            <li> <a href="index.php?seccion=etsiit">ETSIIT </a> </li>
        </ul>
    </li>
    <li><a href="index.php?seccion=como_llegar">Como llegar</a>
        <ul>
            <li> <a href="index.php?seccion=localizacion#autobus">Autobús</a> </li>
            <li> <a href="index.php?seccion=localizacion#renfe">Tren</a> </li>
            <li> <a href="index.php?seccion=localizacion#aeropuerto">Avión</a> </li>
        </ul>
    </li>
    <li><a href="index.php?seccion=patrocinio">Patrocinio</a>
    </li>
    <li><a href="index.php?seccion=acerca_de">Acerca de</a>
    </li>
    <li><a href="index.php?seccion=contacto">Contacto</a>
    </li>
</ul>

<?php
//$nombre_archivo = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
//echo "Parametro es :" . $nombre_archivo . "<br />";
//$url_actual = $_SERVER["REQUEST_URI"];
//
//echo "<b>$url_actual</b>";
?>
