<?php
    session_start();
    echo '<h2> Opciones de usuario</h2>';
   
    if (isset($_SESSION['nombre'])) {
        echo '<strong>' . $_SESSION['nombre'] . '</strong> (' . $_SESSION['tipo_usuario'] . ')<br /><br />';
                if ($_SESSION['tipo_usuario'] == "administrador") {
            echo '<a href="index.php?seccion=administrador">Ver congresistas</a><br /><br />';
        }
        echo '<a href="#cambiar_password">Cambiar contraseña</a><br /><br />';
        echo '<a href="php/cerrar_sesion.php">Cerrar Sesión</a>';
    } else {
        
        echo '<a href="#iniciar_sesion">Iniciar Sesión</a>';
    }

include 'html/iniciar_sesion.html';
include 'html/iniciar_sesion_error.html';
include 'html/recordar_password.html';
include 'html/usuario_encontrado.html';
include 'html/usuario_no_encontrado.html';
include 'html/cambiar_password.html';
include 'html/password_incorrecto.html';
include 'html/password_correcto.html';
?>
