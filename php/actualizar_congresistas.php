<?php

include_once 'conexion_bd.php';

//busco los congresistas deseados
$consulta = 'SELECT * FROM usuario WHERE tipo_usuario!="Administrador" AND apellidos LIKE "%' . $_POST['apellidos'] . '%"';

//envio la consulta a MySQL
$resultado = conexionBD($consulta);

if (!$resultado) {
    echo '<script>
            alert("ERROR: Al obtener la lista de congresistas.");
            location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
            </script>';
} else {

    //saco el nombre y apellidos de cada congresista
    while ($fila = mysql_fetch_array($resultado)) {
        echo "<tr>";
        echo '<td><a href="index.php?seccion=ficha_inscripcion&congresista=' . $fila['id_usuario'] . '">' . $fila['apellidos'] . '</a></td>';
        echo '<td><a href="index.php?seccion=ficha_inscripcion&congresista=' . $fila['id_usuario'] . '">' . $fila['nombre'] . '</a></td>';
        echo '<td><a href="index.php?seccion=ficha_inscripcion&congresista=' . $fila['id_usuario'] . '">' . $fila['mail'] . '</a></td>';
        echo "</tr>";
    }
}