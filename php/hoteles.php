<?php

if (isset($_GET['ini'])) {
    $fecha_entrada = $_GET['ini'];
} else {
    salir('Falta fecha de entrada.', -2);
}
if (isset($_GET['fin'])) {
    $fecha_salida = $_GET['fin'];
} else {
    salir('Falta fecha de salida.', -2);
}
if (isset($_GET['hab'])) {
    $n_habitaciones = $_GET['hab'];
} else {
    salir('Falta número de habitaciones.', -2);
}
if (isset($_GET['hues'])) {
    $n_huespedes = $_GET['hues'];
} else {
    salir('Falta número de huespedes por habitación.', -2);
}

$dias = ((strtotime($fecha_salida) - strtotime($fecha_entrada)) / 3600 / 24);
if ($dias < 0) {
    salir('La fecha de salida es anterior a la de entrada.', -3);
}

if (new DateTime($fecha_entrada) < new DateTime()) {
    salir('La fecha de entrada tiene que ser posterior a la fecha actual.', -3);
}

$fecha_entrada_url = str_replace("-", "", $fecha_entrada);
$fecha_salida_url = str_replace("-", "", $fecha_salida);

$url = "localhost/GranaHome_php/hoteles/Granada/f_inicio/" . $fecha_entrada_url . "/f_fin/" . $fecha_salida_url . "/hab/" . $n_habitaciones . "/huespedes/" . $n_huespedes;
//echo $url;
//echo "<br>";
$sesion = curl_init($url);
// definir tipo de petición a realizar: POST
curl_setopt($sesion, CURLOPT_POST, false);
// Le pasamos los parámetros definidos anteriormente
//curl_setopt ($sesion, CURLOPT_POSTFIELDS, $parametros_post); 
// sólo queremos que nos devuelva la respuesta
//curl_setopt($sesion, CURLOPT_HEADER, false); 
curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
// ejecutamos la petición
$respuesta = curl_exec($sesion);
// cerramos conexión
curl_close($sesion);

$decode = json_decode($respuesta);

//echo $respuesta;
//echo "<br>";
//echo "<br>";
//echo var_dump($decode);
//echo "<br>";

echo '<table class="tablaBusqueda">';
for ($i = 0; $i < count($decode); $i++) {
    echo '<tr>';
    echo '<td class="centrado_horizontal">';
    echo '<img class="centrada borde_blanco" src="' . $decode[$i]->foto_alojamiento . '" alt="Foto de ' . $decode[$i]->nombre_hotel . '" />';
    echo '</td>';
    echo '<td class="descripcion">';
    echo '<h2> ' . $decode[$i]->nombre_hotel . ' <img src="images/icon_estrella_' . $decode[$i]->num_estrellas . '.png" /></h2>';

    echo '<i> ' . $decode[$i]->direccion . ', Granada </i>';
//    echo '<i> Dirección, Granada </i>';
    echo '<br><br>';
    echo $decode[$i]->descripcion;
    echo '<br><br>';
    for ($j = 0; $j < count($decode[$i]->detalle_tipo); $j++) {
        $precio = $decode[$i]->detalle_tipo[$j]->precio * $dias * $n_habitaciones;
        echo '<hr/>';
        echo '<br>';
        echo '<form method="post" action="php/reservar_hotel.php">';
        echo '<input type="hidden" name="hotel" value="' . $decode[$i]->id_hotel . '"/>';
        echo '<input type="hidden" name="hab" value="' . $decode[$i]->detalle_tipo[$j]->id_tipo . '"/>';
        echo '<input type="hidden" name="ini" value="' . $fecha_entrada . '"/>';
        echo '<input type="hidden" name="fin" value="' . $fecha_salida . '"/>';
        echo '<input type="hidden" name="num" value="' . $n_habitaciones . '"/>';
        echo '<input type="hidden" name="precio" value="' . $precio . '"/>';
        echo '<h4> ' . $decode[$i]->detalle_tipo[$j]->nombre_tipo . ' </h4>';
        if($n_habitaciones == 1){
            echo "1 habitación para ";
        }else{
            echo $n_habitaciones . " habitaciones para ";
        }
        echo $decode[$i]->detalle_tipo[$j]->capacidad . ' personas -> ';
        echo  $precio . ' € ';
        echo '<button type="submit" id="masInfo" name="masInfo">Reservar</button>';
        echo '</form>';
        echo '<br>';
//        echo '<br>';
    }
    echo '<hr/>';
//    echo '<br><br>';
//    echo '<a href="index.php?sec=alojamiento&aloj=' . $decode[$i]->id_hotel . '" >';
//    echo '<button type="submit" id="masInfo" name="masInfo">Reservar</button>';
//    echo '</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='index.php?seccion=inscribete';
        </script>";
    exit($code);
}

?>