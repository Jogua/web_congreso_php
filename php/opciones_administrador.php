<?php

if ($_SESSION['tipo_usuario'] == "administrador") {

    if (isset($_GET['congresista'])) {
        //busco los datos del congresista
        $consulta = 'SELECT * FROM usuario WHERE mail="' . $_GET['congresista'] . '"';// AND tipo_usuario!="administrador"';

        //envio la consulta a MySQL
        $resultado = conexionBD($consulta);

        $fila = mysql_fetch_array($resultado);
        echo "<table>";
        echo "<tr>";
        echo "<td>Nombre</td>";
        echo "<td>Apellidos</td>";
        echo "<td>Centro de trabajo</td>";
        echo "<td>E-mail</td>";
        echo "<td>Cuota Inscripción</td>";
        echo "<td>Tipo de usuario</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $fila['nombre'] . "</td>";
        echo "<td>" . $fila['apellidos'] . "</td>";
        echo "<td>" . $fila['centro_trabajo'] . "</td>";
        echo "<td>" . $fila['mail'] . "</td>";
        echo "<td>" . $fila['cuota_inscripcion'] . "</td>";
        echo "<td>" . $fila['tipo_usuario'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        //busco todos los congresistas
        $consulta = 'SELECT * FROM usuario';// WHERE tipo_usuario!="administrador"';

        //envio la consulta a MySQL
        $resultado = conexionBD($consulta);

        if (mysql_num_rows($resultado) == 0) {
            echo '<h2>Congresistas</h2>';
            echo 'Actualmente no hay congresistas inscritos en el congreso.';
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>Apellidos</td>";
            echo "</tr>";

            //saco el nombre y apellidos de cada congresista
            while ($fila = mysql_fetch_array($resultado)) {
                echo "<tr>";
                echo '<td><a href="index.php?seccion=administrador&congresista=' . $fila['mail'] . '">' . $fila['nombre'] . '</a></td>';
                echo "<td>" . $fila['apellidos'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
?>
