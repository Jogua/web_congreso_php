<?php

switch ($seccion) {
    case "detalle_ponencia":
    case "detalle_visita":
    case "actividades":
    case "inscribete":
    case "editar_actividad":
    case "ficha_inscripcion":
        $direccion = './php/' . $seccion . '.php';
        break;
    case "administrador":
        $direccion = './php/opciones_administrador.php';
        break;
    case "cuotas":
        $direccion = './php/editar_cuotas.php';
        break;
    case "hoteles":
        $direccion = './php/busqueda_hoteles.php';
        break;
    default:
        $direccion = './html/' . $seccion . '.html';
        break;
}

include $direccion;
?>
