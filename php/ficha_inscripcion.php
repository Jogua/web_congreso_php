<?php
if (session_status() == PHP_SESSION_DISABLED) {
    session_start();
}

if (isset($_SESSION['tipo_usuario'])) {
    $tipo_usuario = $_SESSION['tipo_usuario'];
} else {
    echo "<h2> Tienes que iniciar sesión </h2>";
    return;
}

if (isset($_GET['congresista'])) {
    $id_congresista = $_GET['congresista'];
} else {
    $id_congresista = false;
}

if ($tipo_usuario == 'Congresista') {
    $consulta_usuario = "SELECT id_usuario FROM usuario WHERE mail='" . $_SESSION['mail'] . "'";
    $resultado_usuario = conexionBD($consulta_usuario);
    if (!$resultado_usuario) {
        salir("Error de conexión", -3);
    }
    $fila_usuario = mysql_fetch_array($resultado_usuario);
    $id_congresista = $fila_usuario['id_usuario'];
} else if ($tipo_usuario == 'Administrador' && $id_congresista == false) {
    echo "<script type='text/javascript'>
            alert('No se ha encontrado al congresista');
            location.href='index.php?seccion=administrador';
        </script>";
    exit(-2);
}

//busco los datos del congresista
$consulta = 'SELECT * FROM usuario, cuota WHERE id_usuario=' . $id_congresista
        . ' AND tipo_usuario!="Administrador"'
        . ' AND cuota_inscripcion=id_cuota';

//envio la consulta a MySQL
$resultado = conexionBD($consulta);

if (!$resultado) {
    salir("No se han podido obtener los datos.", -3);
} else {
    $fila = mysql_fetch_array($resultado);

    $precio_congreso = $fila['importe'];

    $consulta_actividades = 'SELECT * FROM usuario_tiene_actividad, actividad WHERE id_usuario=' . $id_congresista
            . ' AND usuario_tiene_actividad.id_actividad=actividad.id_actividad';

    //envio la consulta a MySQL
    $resultado_actividades = conexionBD($consulta_actividades);

    if (!$resultado_actividades) {
        salir("No se han podido obtener las actividades.", -3);
    } else {

        $consulta_actividades_incluidas = 'SELECT * FROM cuota_tiene_actividad, actividad WHERE id_cuota=' . $fila['id_cuota']
                . ' AND cuota_tiene_actividad.id_actividad=actividad.id_actividad';

        //envio la consulta a MySQL
        $resultado_actividades_incluidas = conexionBD($consulta_actividades_incluidas);

        if (!$resultado_actividades_incluidas) {
            salir("No se han podido obtener las actividades.", -3);
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
                $precio_congreso += $fila_actividades['importe'];
            }
            while ($fila_actividades = mysql_fetch_array($resultado_actividades_incluidas)) {
                echo '<li>' . $fila_actividades['nombre_actividad'] . ' (Incluída en la cuota de inscripción)</li>';
            }
            echo '</ul>';
            echo '<br>';
            echo 'Importe del congreso: ' . $precio_congreso . ' €';
            echo '<br><br><br>';

            $consulta_hotel = "SELECT * FROM usuario_reserva_hotel WHERE id_usuario=" . $id_congresista;
            $resultado_hotel = conexionBD($consulta_hotel);
            $precio_alojamiento = 0;
            if ($resultado_hotel) {
                if (mysql_num_rows($resultado_hotel) == 0) {
                    echo '<h2>No se ha reservado ningún alojamiento</h2>';
                } else {
                    $fila_hotel = mysql_fetch_array($resultado_hotel);
                    echo '<h2>Detalles del alojamiento</h2>';
                    echo 'Hotel: ' . $fila_hotel['nombre_hotel'];
                    echo '<br>';
                    echo 'Habitación: ' . $fila_hotel['nombre_habitacion'];
                    echo '<br>';
                    echo 'Reserva: ';
                    if ($fila_hotel['numero_habitaciones'] == 1) {
                        echo "1 habitación";
                    } else {
                        echo $fila_hotel['numero_habitaciones'] . " habitaciones";
                    }
                    echo '<br><br>';
                    $precio_alojamiento = $fila_hotel['importe'];
                    echo 'Importe del alojamiento: ' . $precio_alojamiento . " €";
                    echo '<br><br><br>';
                }
            }
            echo '<h4> Precio total: ' . ($precio_congreso + $precio_alojamiento) . ' €</h4>';
        }
    }
}

function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='index.php?seccion=inscribete';
        </script>";
    exit($code);
}
?>