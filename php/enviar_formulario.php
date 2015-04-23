<?php

require_once 'enviar_mail.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];

$asunto = '[Mensaje de Web] Mensaje de usuario';
$mensaje = $nombre . ' ' . $apellidos . ' (' . $email . ') ha escrito el siguiente mensaje: <br/><br/>'
        . $_POST['mensaje'];

if (enviarMail('congresoCEIIE@gmail.com', $asunto, $mensaje)) {
    $mensaje = $nombre . ' ' . $apellidos . ' tu consulta ha sido recibida correctamente. 
    Le contestaremos lo antes posible.';

    enviarMail($email, $asunto, $mensaje); //si este falla no nos importa, ya que es una respuesta automatica al usuario
    echo "<script>
            alert('El email se ha enviado correctamente');
            location.href='../index.php?seccion=contacto';
        </script>";
}else{
    echo "<script>
            alert('El email no se ha podido enviar. <br/> Intentelo más tarde.');
            location.href='../index.php?seccion=contacto';
        </script>";
}

?>

