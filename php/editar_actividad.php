<?php

include_once 'conexion_bd.php';

$consulta = 'SELECT * FROM actividad WHERE id_actividad=' . $_GET['id'];

//Envio la consulta a MySQL.
$resultado = conexionBD($consulta);

if ($resultado) {
    $fila = mysql_fetch_array($resultado);
    if ($fila) {
        echo '<form action="php/modificar_actividad.php" method="post">';
        echo '<input type="hidden" name="id" value=' . $_GET['id'] . ' />'; 
        echo '<label for="nombre_actividad">Nombre de la actividad: </label>';
        echo '<input type="text" id="nombreactividad" name="nombre_actividad" maxlength="50" size="50" value="' . $fila['nombre_actividad'] . '" required />';

        echo "<br><br><img class='centrada borde_blanco' src=" . $fila['url_foto'] . " title='Imagen de la actividad' alt='Imagen de la actividad' />";

        echo '<label for="fecha_hora">Fecha y hora: </label>';
        $fecha_hora = str_replace(" ", "T", $fila['fecha_hora']);
        echo '<input type="datetime-local" id="fecha_hora" name="fecha_hora" value="' . $fecha_hora . '" required /><br><br>';

        echo 'Precio: ' . $fila['importe'] . ' €<br><br>';
//        echo '<label for="importe">Importe: </label>';
//        echo '<input type="text" id="importe" name="importe" maxlength="6" size="6" value="' . $fila['importe'] . '" required readonly /><br><br>';

        
        echo '<label for="descripcion">Descripcion: </label><br>';
        echo '<textarea id="text_area_descripcion" name="descripcion" rows="20" cols="75" maxlength="2000" required>' . $fila['descripcion'] . '</textarea><br><br>';

        echo '<button class="submit" type="submit">Guardar cambios</button>';
        echo '</form>';
    }
} else {
    echo '<script>
            alert("Error al cargar la actividad.");
            location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
}
?>
