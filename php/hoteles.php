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

$dias = ((strtotime($fecha_salida) - strtotime($fecha_entrada))/3600/24);
echo "<br>";

echo $fecha_entrada;
echo "<br>";
echo $fecha_salida;
echo "<br>";
echo $dias;
echo " dias <br>";
echo $n_habitaciones;
echo "<br>";
echo $n_huespedes;
echo "<br>";

$fecha_entrada = str_replace("-", "", $fecha_entrada);
$fecha_salida = str_replace("-", "", $fecha_salida);

$url = "localhost/GranaHome_php/hoteles/Granada/f_inicio/" . $fecha_entrada . "/f_fin/" . $fecha_entrada . "/hab/" . $n_habitaciones . "/huespedes/" . $n_huespedes;

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
    echo '<img src="' . $decode[$i]->foto_alojamiento . '" alt="Foto de ' . $decode[$i]->nombre_hotel . '" />';
    echo '</td>';
    echo '<td class="descripcion">';
//        echo '<h2> ' . $decode[$i]->nombre_hotel . ' <img src="n_estrellas.jpg" /></h2>';
    echo '<h2> ' . $decode[$i]->nombre_hotel . ' (nº estrellas) </h2>';

//    echo '<i> ' . $fila_alojamiento['direccion'] . ', Granada </i>';
    echo '<i> Dirección, Granada </i>';
    echo '<br><br>';
//    echo $fila_alojamiento['descripcion_breve'];
//    echo '<br><br>';
    for ($j = 0; $j < count($decode[$i]->detalle_tipo); $j++) {
        echo '<hr/>';
        echo '<h4> ' . $decode[$i]->detalle_tipo[$j]->nombre_tipo . ' </h4>';
        echo $decode[$i]->detalle_tipo[$j]->capacidad . ' personas <br>';
        echo $decode[$i]->detalle_tipo[$j]->precio * $dias . ' € ';
        echo '<button type="submit" id="masInfo" name="masInfo">Reservar</button>';
        echo '<br><br>';
    }
        echo '<hr/>';
    echo '<br><br>';
//    echo '<a href="index.php?sec=alojamiento&aloj=' . $decode[$i]->id_hotel . '" >';
//    echo '<button type="submit" id="masInfo" name="masInfo">Reservar</button>';
    echo '</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

//
//foreach ($decode as $key => $value) {
//    echo $key . " -> "  . "<br>";
//}


function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='../index.php?seccion=inscribete';
        </script>";
    exit($code);
}

?>