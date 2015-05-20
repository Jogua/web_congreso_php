function comprueba_formulario(f) {
    if (comprueba_mail(f)) {
        if (check_password(f)) {
            return true;
        }
    }
    return false;
}

function comprueba_mail(f) {
    var re = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!re.test(f.mail.value)) {
        alert("ERROR: Email incorrecto. Inténtelo de nuevo.");
        return false;
    }
    return true;
}

function check_password(f) {
    var password1 = f.password.value;
    var password2 = f.confirmar_password.value;
    if (password1 != password2) {
        alert("Las contraseñas no coinciden.");
        return false;
    }
    if (password1.length < 8) {
        alert("La contraseña tiene que contener al menos 8 caracteres.");
        return false;
    }
    return true;
}

function validar_usuario(select) {
    //2 -> profesor / 3-> Estudiante
    if (select.value == "2" || select.value == "3") {
        document.getElementById("universidad").innerHTML = "<li>" +
                " <label for=\"universidad\"> Universidad:</label> " +
                " <input type=\"text\" name=\"universidad\" required/> " +
                "</li>";
    } else {
        document.getElementById("universidad").innerHTML = "";
    }
    actualizar_actividades(select.value);
    actualizar_precio();
}

function actualizar_actividades(usuario) {
    var act_incluidas_0 = [];
    var act_incluidas_1 = [];
    var act_incluidas_2 = ["act_3", "act_4"];
    var act_incluidas_3 = [];

    var actividad;
    for (var i = 1; i <= 4; i++) {
        actividad = document.getElementById("act_" + i);
        actividad.checked = false;
        actividad.disabled = false;
    }

    if (usuario == 2) {
        for (var i = 0; i <act_incluidas_2.length; i++) {
            actividad = document.getElementById(act_incluidas_2[i]);
            actividad.checked = true;
            actividad.disabled = true;
        }
    }
}

function actualizar_precio() {
    var precio;

    var usuario = document.getElementById("cuota").value;
    if (usuario == "1") {//Invitado
        precio = 50;
    } else if (usuario == "2") { // Profesor
        precio = 45;
    } else if (usuario == "3"){ // Estudiante
        precio = 25;
    }
    
    var precio_actividades = [25,15,20,30];
    var actividad;
    for (var i = 1; i <= 4; i++) {
        actividad = document.getElementById("act_" + i);
        if(actividad.checked && !actividad.disabled){
            precio += precio_actividades[i-1];
        }
    }

    document.getElementById("precio").innerHTML = "Precio Total: " + precio + "€";
}
