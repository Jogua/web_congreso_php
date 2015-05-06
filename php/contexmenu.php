<?php
    echo '<div id="opcionesUsuario">';    
    include './php/opciones_usuario.php';
    echo '</div>';
    
    if ($id != 0) {
        include './php/ponencias_relacionadas.php';
    }
    
    include './html/slider_patrocinadores.html';
?>
