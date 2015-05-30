<?php

if ($_SESSION['tipo_usuario'] == "Administrador") {

    if (isset($_GET['congresista'])) {
        //busco los datos del congresista
        $consulta = 'SELECT * FROM usuario, cuota WHERE id_usuario=' . $_GET['congresista']
                . ' AND tipo_usuario!="Administrador"'
                . ' AND cuota_inscripcion=id_cuota';

        //envio la consulta a MySQL
        $resultado = conexionBD($consulta);

        if (!$resultado) {
            echo '<script>
            alert("ERROR: Al obtener detalles de congresista.");
            location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
            </script>';
        } else {
            $fila = mysql_fetch_array($resultado);

            $precio_total = $fila['importe'];

            $consulta_actividades = 'SELECT * FROM usuario_tiene_actividad, actividad WHERE id_usuario=' . $_GET['congresista']
                    . ' AND usuario_tiene_actividad.id_actividad=actividad.id_actividad';

            //envio la consulta a MySQL
            $resultado_actividades = conexionBD($consulta_actividades);

            if (!$resultado_actividades) {
                echo '<script>
                alert("ERROR: Al obtener la lista de actividades.");
                location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
                </script>';
            } else {

                $consulta_actividades_incluidas = 'SELECT * FROM cuota_tiene_actividad, actividad WHERE id_cuota=' . $fila['id_cuota']
                        . ' AND cuota_tiene_actividad.id_actividad=actividad.id_actividad';

                //envio la consulta a MySQL
                $resultado_actividades_incluidas = conexionBD($consulta_actividades_incluidas);

                if (!$resultado_actividades_incluidas) {
                    echo '<script>
                alert("ERROR: Al obtener la lista de actividades.");
                location.href= " ' . $_SERVER ['HTTP_REFERER'] . '";
                </script>';
                } else {

                    echo '<h2>Detalles de un congresista</h2>';

                    echo 'Nombre: ' . $fila['nombre'] . '<br />';
                    echo 'Apellidos: ' . $fila['apellidos'] . '<br />';
                    echo '<br>';
                    echo 'E-mail: ' . $fila['mail'] . '<br />';
                    echo '<br>';
                    echo 'Cuota de usuario: ' . $fila['nombre_cuota'] . ' (' . $fila['importe'] . ' €)<br />';
                    echo '<ul>';
                    while ($fila_actividades = mysql_fetch_array($resultado_actividades)) {
                        echo '<li>' . $fila_actividades['nombre_actividad'] . ' (' . $fila_actividades['importe'] . ' €)</li>';
                        $precio_total += $fila_actividades['importe'];
                    }
                    while ($fila_actividades = mysql_fetch_array($resultado_actividades_incluidas)) {
                        echo '<li>' . $fila_actividades['nombre_actividad'] . ' (Incluída en la cuota de inscripción)</li>';
                    }
                    echo '</ul>';
                    echo '<br>';
                    echo 'Importe total: ' . $precio_total . ' €';
                }
            }
        }
    } else {
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
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['id_usuario'] . '">' . $fila['apellidos'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['id_usuario'] . '">' . $fila['nombre'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['id_usuario'] . '">' . $fila['mail'] . '</a></td>';
                    echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['id_usuario'] . '">' . $fila['tipo_usuario'] . '</a></td>';

                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        }
    }
}
?>
