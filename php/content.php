<?php

switch ($seccion) {
    case "detalle_ponencia":
    case "detalle_visita":
    case "actividades":
    case "inscribete":
        $direccion = './php/' . $seccion . '.php';
        break;
    case "administrador":
        $direccion = './php/opciones_administrador.php';
        break;
    default:
        $direccion = './html/' . $seccion . '.html';
        break;
}

include $direccion;
?>
