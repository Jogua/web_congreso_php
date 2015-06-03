<?php

if ($_SESSION['tipo_usuario'] == "Administrador") {


    //busco todos los congresistas
    $consulta = 'SELECT * FROM usuario WHERE tipo_usuario!="Administrador"';

    //envio la consulta a MySQL
    $resultado = conexionBD($consulta);

    if (!$resultado) {
        echo '<script>
            alert("ERROR: Al obtener la lista de congresistas.");
            location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
            </script>';
    } else {

        echo '<h2>Congresistas</h2>';

        if (mysql_num_rows($resultado) == 0) {
            echo 'Actualmente no hay congresistas inscritos en el congreso.';
        } else {
            echo 'Búsqueda por apellidos: ';
            echo '<input type="search" name="buscar" onkeyup="actualizar_congresistas(this.value);" size="36" /><br><br>';
            echo '<table id="ponencias">
            <thead class="negrita">
            <td class="columnaPonencias centrar">Apellidos</td>
            <td class="columnaPonencias centrar">Nombre</td>
            <td class="columnaPonencias centrar">E-Mail</td>
            </thead>
            <tbody id="busqueda_congresistas">';

            //saco el nombre y apellidos de cada congresista
            while ($fila = mysql_fetch_array($resultado)) {
                echo "<tr>";
                echo '<td><a href="index.php?seccion=ficha_inscripcion&congresista=' . $fila['id_usuario'] . '">' . $fila['apellidos'] . '</a></td>';
                echo '<td><a href="index.php?seccion=ficha_inscripcion&congresista=' . $fila['id_usuario'] . '">' . $fila['nombre'] . '</a></td>';
                echo '<td><a href="index.php?seccion=ficha_inscripcion&congresista=' . $fila['id_usuario'] . '">' . $fila['mail'] . '</a></td>';
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
    }
}
?>
