<?php

require_once 'enviar_mail.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$usuario = $_POST['nombreUsuario'];
$contrasena = $_POST['contrasena'];
$tipoUsuario = $_POST['tipoUsuario'];
$actividades = $_POST['actividades'];
$actividadesInscritas = "";

switch ($tipoUsuario) {
    case 'estudiante':
        $precio = 15;
        $universidad = ' de ' . $_POST['universidad'];
        break;
    case 'profesor':
        $precio = 20;
        $universidad = ' de ' . $_POST['universidad'];
        break;
    default:
        $precio = 30;
        $universidad = "";
        break;
}

if (!empty($actividades)) {
    $actividadesInscritas = 'Además, se ha inscrito en las siguientes actividades: <br/><br/>';

    if (in_array('alhambra', $actividades)) {
        $actividadesInscritas = $actividadesInscritas . "     - Visita a la Alhambra.<br/>";
        $precio += 15;
    }
    if (in_array('sierra', $actividades)) {
        $actividadesInscritas = $actividadesInscritas . "     - Viaje a Sierra Nevada.<br/>";
        $precio += 20;
    }
}

$asunto = '[Mensaje de Web] Inscripción al congreso';
$mensaje = $nombre . ' ' . $apellidos . ' se ha inscrito al congreso en la categoria de '
        . $tipoUsuario . $universidad . '.<br/><br/>' . $actividadesInscritas
        . '<br/> El precio total es de: ' . $precio . '€<br/><br/>'
        . 'La forma de pago consiste en realizar una trasnferencia indicando su nombre de usuario al siguiente 
        número de cuenta: <br/><br/> 2100 4323 54 2516300484 <br/><br/> Tras realizar la transferencia debe enviar a "congresosCEIIE@gmail.com"
        un justificante de dicho pago con el asunto "Confirmación pago ' . $usuario . '".<br/><br/>'
        . '¡Nos vemos pronto!';

if (enviarMail($email, $asunto, $mensaje)) {
    $asunto = '[Mensaje de Web] Inscripción de usuario';
    $mensaje = $nombre . ' ' . $apellidos . ' se ha inscrito al congreso en la categoria de '
            . $tipoUsuario . $universidad . '.<br/><br/>' . $actividadesInscritas
            . '<br/> El precio total es de: ' . $precio . '€<br/><br/>';
    enviarMail('congresoCEIIE@gmail.com', $asunto, $mensaje); //si este falla no nos importa, ya que es una confirmación a nuestro correo
    echo "<script>
            alert('El email se ha enviado correctamente');
            location.href='../index.php?seccion=inscribete';
        </script>";
} else {
    echo "<script>
            alert('El email no se ha podido enviar. \n Intentelo más tarde.');
            location.href='../index.php?seccion=inscribete';
        </script>";
}
?>