<?php

$file = fopen('datos/actividades.txt', 'r');
$paso = 0;
$leyendoDescripcion = false;
while (!feof($file)) {
    $line = fgets($file);
    if (strncmp("#nombre", $line, 7) == 0) { //Compara si es una nueva actividad.
        $paso = 1;
    } else if ($paso == 1) {  //Lee el nombre de la actividad
        if (stripos($line, $visita) != FALSE) { //Si es la actividad buscada se muestra el titulo y aumenta el paso.
            echo "<h2>" . $line . "</h2>";
            $paso = 2;
        } else { //Si esta actividad no es, busca hasta encontrar otra actividad diferente
            $paso = 0;
        }
    } else if ($paso == 2) { //Busqueda de tokens.
        if (strncmp($line, "#imagen", 7) == 0) {
            $paso = 3;
        } else if (strncmp($line, "#fecha", 6) == 0) {
            $paso = 4;
        } else if (strncmp($line, "#descripción", 12) == 0) {
            $paso = 5;
            $leyendoDescripcion = true;
        } else if (strncmp($line, "#", 7) == 0) {
            $paso = 6;
        } else if($leyendoDescripcion){
            echo $line;
        }
    } else if ($paso == 3) { //lee la ruta de la imagen
        echo "<img class=\"centrada\" src=" . $line . "title=\"Imagen de la actividad\""
        . "alt=\"Imagen de la actividad\" />";
        $paso = 2;
    } else if ($paso == 4) { //lee la fecha
        echo "<p class=\"negrita\"> Fecha: " . $line . "</p>";
        $paso = 2;
    } else if ($paso == 5) { //lee la descripción
        echo "<p>" . $line;
        $paso = 2;
    } else if ($paso == 6) { //lee
        echo "<img src=" . $line . "title=\"Imagen de la actividad\" alt=\"Imagen de la actividad\" />";
        $paso = 2;
    }
}
if($leyendoDescripcion){
    echo "</p>";
}

fclose($file);
?>

