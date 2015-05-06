<?php
    if ($_SESSION['tipo_usuario'] == "administrador") {
        //comprobación de que el usuario exista
        $consulta = 'SELECT * FROM usuario';

        //Envio la consulta a MySQL.
        $resultado = conexionBD($consulta);

        if (mysql_num_rows ($resultado) == 0) {
            echo '<h2>Congresistas</h2>';
            echo 'Actualmente no hay congresistas.';
        } else {
            while ($fila = mysql_fetch_array($resultado)) {
                echo $fila['nombre'] . " " . $fila['apellidos'] . "<br />";
            }
        }
    }
?>
