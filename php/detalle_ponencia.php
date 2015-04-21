<?php

if ($id > 0 && $id <=3) {
    include 'ponencias/ingenieria_software.php';
} else if ($id >=4 && $id <= 6) {
    include 'ponencias/informatica_grafica.php';
} else if ($id >=7 && $id <= 9) {
    include 'ponencias/bases_datos.php';
}else if ($id >=10 && $id <= 12) {
    include 'ponencias/compiladores.php';
}else if ($id >=13 && $id <= 15) {
    include 'ponencias/sistemas_operativos.php';
}else if ($id >=16 && $id <= 18) {
    include 'ponencias/sistemas_complejos.php';
}else if ($id >=19 && $id <= 21) {
    include 'ponencias/interfaces_usuario.php';
}
?>