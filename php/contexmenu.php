<?php
    if ($id != 0) {
        include './php/ponencias_relacionadas.php';
    }
    
    echo '<div id="opcionesUsuario">';    
    include 'php/opciones_usuario.php';
    echo '</div>';
    
    include './html/slider_patrocinadores.html';
?>
