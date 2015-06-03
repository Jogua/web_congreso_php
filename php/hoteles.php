<?php

$dias = 2;

$url = "localhost/GranaHome_php/hoteles/Granada/f_inicio/20150601/f_fin/20150603/hab/1/huespedes/2";
//echo $url;

$sesion = curl_init($url);
// definir tipo de petición a realizar: POST
curl_setopt($sesion, CURLOPT_POST, false);
// sólo queremos que nos devuelva la respuesta
curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
// ejecutamos la petición
$respuesta = curl_exec($sesion);
// cerramos conexión
curl_close($sesion);

$decode = json_decode($respuesta);


echo '<table class="tablaBusqueda">';
for ($i = 0; $i < count($decode); $i++) {
    echo '<tr>';
    echo '<td class="centrado_horizontal">';
    echo '<img class="centrada borde_blanco" src="' . $decode[$i]->foto_alojamiento . '" alt="Foto de ' . $decode[$i]->nombre_hotel . '" />';
    echo '</td>';
    echo '<td class="descripcion">';
    echo '<h2> ' . $decode[$i]->nombre_hotel . ' <img src="images/icon_estrella_' . $decode[$i]->num_estrellas . '.png" /></h2>';

    echo '<i> ' . $decode[$i]->direccion . ', Granada </i>';
    echo '<br><br>';
    echo $decode[$i]->descripcion;
    echo '<br><br>';
    for ($j = 0; $j < count($decode[$i]->detalle_tipo); $j++) {
        $precio = $decode[$i]->detalle_tipo[$j]->precio * $dias;
        echo '<hr/>';
        echo '<br>';
        $id_tipo_habitacion = $decode[$i]->detalle_tipo[$j]->id_tipo;
        echo '<input type="hidden" name="hotel_' . $id_tipo_habitacion . '" value="' . $decode[$i]->id_hotel . '"/>';
        echo '<input type="hidden" name="precio_' . $id_tipo_habitacion . '" value="' . $precio . '"/>';
        echo '<h4> ' . $decode[$i]->detalle_tipo[$j]->nombre_tipo . ' </h4>';
        echo '<ul><li>';
        echo '<input type="radio" id="habitacion_' . $id_tipo_habitacion . '" name="habitacion" value="' . $id_tipo_habitacion . '" onchange="cambiar_precio_alojamiento(' . $precio . ')"/>';
        echo '<label for="habitacion_' . $id_tipo_habitacion . '">';
        echo "1 habitación para " . $decode[$i]->detalle_tipo[$j]->capacidad . ' personas -> ' . $precio . ' € <br>';
        echo '</label>';
        echo '</li></ul>';
    }
    echo '<hr/>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='index.php?seccion=ficha_inscripcion';
        </script>";
    exit($code);
}

?>