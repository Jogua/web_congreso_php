<?php

require_once ("../php/phpmailer/class.phpmailer.php");
require_once ("../php/phpmailer/class.smtp.php");
    
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $destino = $_POST['email'];
    $mensaje = $nombre . ' ' . $apellidos . ' ha escrito el siguiente mensaje: <br/><br/>' . $_POST['mensaje'];

    $mail = new PHPMailer();
    $mail -> IsSMTP();
    $mail -> SMTPAuth = 'true';
    $mail -> SMTPSecure = 'tls';
    $mail -> SMTPKeepAlive = true;
    $mail -> Host = 'smtp.gmail.com';
    $mail -> Port = 587;
    $mail -> IsHTML(true); 

    $mail -> Username = "congresoCEIIE@gmail.com";
    $mail -> Password = "sibw2015";
    $mail -> SingleTo = true; 

    $to = $destino;                           
    $from = 'congresoCEIIE@gmail.com';
    $fromname = 'Congreso CEIIE';
    $subject = '[Mensaje de Web] Asunto';
    $message = $mensaje;
    $headers = "From: $from\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";

    $mail -> From = $from;
    $mail -> FromName = $fromname;
    $mail -> AddAddress($to);

    $mail -> Subject = $subject;
    $mail -> Body    = $message;

    if(!$mail -> Send()){
        echo "Message could not be sent. <p>";
        echo "Mailer Error: " . $mail-> ErrorInfo;
        exit;
    }
    
    header('Location: ../index.php?seccion=contacto')
?>
