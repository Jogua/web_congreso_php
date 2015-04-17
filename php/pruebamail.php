<?php

include("./phpmailer/class.phpmailer.php");
include("./phpmailer/class.smtp.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "sibwcongreso@gmail.com";
$mail->Password = "congresosibw";

$mail->From = "sibwcongreso@gmail.com";
$mail->FromName = "Congreso SIBW";
$mail->Subject = "Mail de prueba desde php";
$mail->AltBody = "AltBody -- > texto plano: Este es un mail de prueba.\n";
$mail->MsgHTML("MsgHTML --> texto HMTL: Hola, te doy mi nuevo numero.");
$mail->AddAddress("jonnny0@hotmail.com", "Destinatario");
$mail->IsHTML(true);

if (!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Mensaje enviado correctamente";
}
?>