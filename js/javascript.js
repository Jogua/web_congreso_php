/*función que comprueba el formulario de envío de mensaje*/
function comprueba_formulario(f) {
    var re = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!re.test(f.email.value)) {
        alert("ERROR: Email incorrecto. Intentelo de nuevo.");
        return false;
    }
    alert("Gracias por contactar con nosotros.\nEn breve recibirás respuesta.");
    return false;
}