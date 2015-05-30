<?php

include 'html/recordar_password.html';

session_start();
echo '<h2> Opciones de usuario</h2>';

if (isset($_SESSION['mail'])) {


    echo '<strong>' . $_SESSION['mail'] . '</strong> <br/>'
    . '(' . $_SESSION['tipo_usuario'] . ')<br /><br />';
    if ($_SESSION['tipo_usuario'] == "Administrador") {
        echo '<a href="index.php?seccion=administrador">Ver congresistas</a><br /><br />';
        echo '<a href="index.php?seccion=cuotas">Ver cuotas</a><br /><br />';
    }else if ($_SESSION['tipo_usuario'] == "Congresista") {
        echo '<a href="index.php?seccion=ficha_inscripcion">Ver inscripción</a><br /><br />';
    }
    echo '<a href="#cambiar_password">Cambiar contraseña</a><br /><br />';
    echo '<a href="php/cerrar_sesion.php">Cerrar Sesión</a>';
} else {

    
    if (isset($_GET['error'])) {
        echo "<p id='mail_incorrecto' class='negrita'><br />E-mail / Contraseña incorrectos</p>";
        $error="?error=1";
    } else {
        echo "<br />";
        $error="";
    }

    echo '<div id="iniciar_sesion">';
    echo '<form action="php/comprobar_usuario.php' . $error . '" onsubmit="return comprueba_mail(this)" method="POST">';
    echo '<label for="email"><strong>E-Mail:</strong></label>
            <br />
            <input type="email" id="email" name="email" required />
            <br /><br />
            <label for="password"><strong>Contraseña:</strong></label>
            <br />
            <input type="password" id="password" name="password" required />
            <br /><br />
            <a id="recordar_password" href="#recordar_password">¿Has olvidado tu contraseña?</a>
            <br /><br />
            <button type="submit" title="Iniciar Sesión" name="iniciarSesion"> Iniciar Sesión </button>
        </form>
        </div>
        ';
}

//include 'html/iniciar_sesion.html';
//include 'html/iniciar_sesion_error.html';
include 'html/registrarse.html';
include 'html/usuario_encontrado.html';
include 'html/usuario_no_encontrado.html';
include 'html/cambiar_password.html';
include 'html/password_incorrecto.html';
include 'html/password_correcto.html';
?>
