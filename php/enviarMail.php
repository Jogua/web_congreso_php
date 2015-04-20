<?php

require_once ("../php/phpmailer/class.phpmailer.php");
require_once ("../php/phpmailer/class.smtp.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$remitente = $_POST['email'];
$mensaje = $nombre . ' ' . $apellidos . ' (' . $remitente .  ') ha escrito el siguiente mensaje: <br/><br/>' . $_POST['mensaje'];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = 'true';
$mail->SMTPSecure = 'tls';
$mail->SMTPKeepAlive = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->IsHTML(true);

$mail->Username = "congresoCEIIE@gmail.com";
$mail->Password = "sibw2015";
$mail->SingleTo = true;

$to = 'congresoCEIIE@gmail.com';
$from = $remitente;
$fromname = $nombre . ' ' . $apellidos;
$subject = '[Mensaje de Web] Mensaje de usuario';
$message = $mensaje;
$headers = "From: $from\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=UTF-8\n";

//$mail->From = $from;

$mail->From = "congresoCEIIE@gmail.com";
$mail->FromName = "CONGRESO CEIIE";
        
//$mail->FromName = $fromname;
//$mail->AddAddress($to);
$mail->AddAddress($remitente);
$mail->AddAddress($mail->From);

$mail->Subject = $subject;
$mail->Body = $message;

$options = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->smtpConnect($options);

if (!$mail->Send()) {
    echo "Message could not be sent. <p>";
    echo "Mailer Error: " . $mail->ErrorInfo;
    exit;
}

//Mensaje que se envía al congreso
//$mail->From = $from;
//$mail->FromName = $fromname;
//$mail->AddAddress($to);
//
//if (!$mail->Send()) {
//    echo "Message could not be sent. <p>";
//    echo "Mailer Error: " . $mail->ErrorInfo;
//    exit;
//}

header('Location: ../index.php?seccion=contacto')
?>
