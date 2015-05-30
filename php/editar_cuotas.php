<?php

if ($_SESSION['tipo_usuario'] == "Administrador") {

    if (isset($_GET['id'])) {
        echo '<h2>Cuota a modificar</h2>';
        //busco la cuota
        $consulta = 'SELECT * FROM cuota WHERE id_cuota=' . $_GET['id'];

        //envio la consulta a MySQL
        $resultado = conexionBD($consulta);

        if (!$resultado) {
            echo '<script>
            alert("ERROR: Al obtener la cuota.");
            location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
            </script>';
        } else {
            $fila = mysql_fetch_array($resultado);
            if ($fila) {
                echo '<form action="php/modificar_cuota.php" method="post">';
                echo '<input type="hidden" name="id" value=' . $_GET['id'] . ' />';
                echo '<label for="nombre_cuota">Nombre de la cuota: </label>';
                echo '<input type="text" id="nombre_cuota" name="nombre_cuota" maxlength="50" size="50" value="' . $fila['nombre_cuota'] . '" required /><br><br>';


                echo 'Precio: ' . $fila['importe'] . ' €<br><br>';

                echo '<label for="descripcion">Descripcion: </label><br>';
                echo '<textarea id="text_area_descripcion" name="descripcion" rows="3" cols="56" maxlength="100" required>' . $fila['descripcion'] . '</textarea><br><br>';

                echo '<button class="submit" type="submit">Guardar cambios</button>';
                echo '</form>';
            }
        }
    } else {

        //busco todas las cuotas
        $consulta = 'SELECT * FROM cuota';

        //envio la consulta a MySQL
        $resultado = conexionBD($consulta);

        if (!$resultado) {
            echo '<script>
            alert("ERROR: Al obtener las cuotas.");
            location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
            </script>';
        } else {

            echo '<h2>Cuotas</h2>';
            if (mysql_num_rows($resultado) == 0) {
                echo 'Actualmente no hay cuotas.';
            } else {
                echo '<table id="cuotas">
            <thead class="negrita">
            <td class="centrar">Nombre</td>
            <td class="centrar">Descripción</td>
            <td class="centrar">Importe</td>
            </thead>
            <tbody>';

                //saco los datos de cada cuota
                while ($fila = mysql_fetch_array($resultado)) {
                    echo "<tr>";
                    echo '<td class="centrar"><a href="index.php?seccion=cuotas&id=' . $fila['id_cuota'] . '">' . $fila['nombre_cuota'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=cuotas&id=' . $fila['id_cuota'] . '">' . $fila['descripcion'] . '</a></td>';
                    echo '<td class="centrar"><a href="index.php?seccion=cuotas&id=' . $fila['id_cuota'] . '">' . $fila['importe'] . ' €</a></td>';
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        }
    }
}
?>
