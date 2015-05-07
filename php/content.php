<?php
    if ($seccion == "detalle_ponencia") { // el ide lo guarda en la parte de la barraDerecha
        $direccion = './php/detalle_ponencia.php';
    } else if ($seccion == "detalle_visita") {
        $visita = $_GET["visita"];
        $direccion = './php/detalle_visita.php';
    } else if ($seccion == "administrador") {    
        $direccion = './php/opciones_administrador.php';
    } else {
        $direccion = './html/' . $seccion . '.html';
    }
    include $direccion;
?>
