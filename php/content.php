<?php

if ($seccion == "detalle_ponencia") {
    $direccion = './php/detalle_ponencia.php';
} else if ($seccion == "detalle_visita") {
    $direccion = './php/detalle_visita.php';
} else {
    $direccion = './html/' . $seccion . '.html';
}

include $direccion;

?>