<?php

if ($_SESSION['tipo_usuario'] == "Administrador") {

    if (isset($_GET['congresista'])) {
        //busco los datos del congresista
        $consulta = 'SELECT * FROM usuario, tipo_usuario WHERE '
                . 'usuario.id_tipo_usuario=tipo_usuario.id_tipo_usuario AND '
                . 'mail="' . $_GET['congresista'] . '" AND nombre_tipo!="Administrador" '
                . 'AND cuota_inscripcion IS NOT NULL';

        //envio la consulta a MySQL
        $resultado = conexionBD($consulta);

        if (!$resultado) {
            echo '<script>
            alert("ERROR: Al obtener detalles de congresista.");
            location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
            </script>';
        } else {
            echo '<h2>Detalles de un congresista</h2>';
            echo '<table id="ponencias">
            <thead class="negrita">
            <td class="columnaPonencias centrar">Apellidos</td>
            <td class="columnaPonencias centrar">Nombre</td>
            <td class="columnaPonencias centrar">E-Mail</td>
            <td class="columnaPonencias centrar">Tipo usuario</td>
            </thead>
            <tbody>';


            $fila = mysql_fetch_array($resultado);


            echo "<tr>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellidos'] . "</td>";
            echo "<td>" . $fila['mail'] . "</td>";
            echo "<td>" . $fila['nombre_tipo'] . "</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
        }
    } else {
        //busco todos los congresistas
        $consulta = 'SELECT * FROM usuario, tipo_usuario WHERE cuota_inscripcion IS NOT NULL AND '
                . 'usuario.id_tipo_usuario=tipo_usuario.id_tipo_usuario '
                . 'ORDER BY (apellidos)';

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
                echo '<table id="ponencias">
            <thead class="negrita">
            <td class="columnaPonencias centrar">Apellidos</td>
            <td class="columnaPonencias centrar">Nombre</td>
            <td class="columnaPonencias centrar">E-Mail</td>
            <td class="columnaPonencias centrar">Tipo usuario</td>
            </thead>
            <tbody>';

                //saco el nombre y apellidos de cada congresista
                while ($fila = mysql_fetch_array($resultado)) {
                    echo "<tr>";
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['mail'] . '">' . $fila['apellidos'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['mail'] . '">' . $fila['nombre'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['mail'] . '">' . $fila['mail'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['mail'] . '">' . $fila['nombre_tipo'] . '</a></td>';

                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        }
    }
}
?>
