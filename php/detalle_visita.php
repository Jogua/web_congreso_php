<?php

include_once 'conexion_bd.php';

if (isset($_GET["visita"])) {
    $visita = $_GET["visita"];
}else{
    $visita = -1;
}

$consulta_actividad = "SELECT * FROM actividad WHERE id_actividad=" . $visita;

$resultado_actividad = conexionBD($consulta_actividad);

if ($resultado_actividad) {
    $fila = mysql_fetch_array($resultado_actividad);
    if ($fila) {
        echo "<h2>" . $fila['nombre_actividad'] . "</h2>";
        echo "<img class='centrada borde_blanco' src=" . $fila['url_foto'] . " title='Imagen de la actividad' alt='Imagen de la actividad' />";
        $fecha = date_create($fila['fecha_hora']);
        
        echo "<p class='negrita'> Fecha: " . date_format($fecha, 'd-m-Y H:i:s') . "</p>";
        echo "<p class='negrita'> Precio: " . $fila['importe'] . " €</p>";
                if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == "Administrador") {
            echo '<p><a href="index.php?seccion=editar_actividad&id=' . $visita . '" > Editar actividad </a></p>';
        }
        $descripcion = explode("\n", $fila['descripcion']);
        foreach ($descripcion as $str) {
            echo "<p>" . $str . "</p>";
        }

    } else {
        echo "<h2> No se ha encontrado una actividad relacionada </h2>";
    }
}
?>

