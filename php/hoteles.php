<?php

if(isset($_GET['ini'])){
    $fecha_entrada = $_GET['ini'];
}else{
    salir('Falta fecha de entrada.', -2);
}
if(isset($_GET['fin'])){
    $fecha_salida = $_GET['fin'];
}else{
    salir('Falta fecha de salida.', -2);
}
if(isset($_GET['hab'])){
    $n_habitaciones = $_GET['hab'];
}else{
    salir('Falta número de habitaciones.', -2);
}
if(isset($_GET['hues'])){
    $n_huespedes = $_GET['hues'];
}else{
    salir('Falta número de huespedes por habitación.', -2);
}

echo $fecha_entrada;
echo "<br>";
echo $fecha_salida;
echo "<br>";
echo $n_habitaciones;
echo "<br>";
echo $n_huespedes;
echo "<br>";




function salir($str, $code) {
    echo "<script type='text/javascript'>
            alert('" . $str . "');
            location.href='../index.php?seccion=inscribete';
        </script>";
    exit($code);
}
?>