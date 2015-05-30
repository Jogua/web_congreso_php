<?php

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
    }
    
    ?>