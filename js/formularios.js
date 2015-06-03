function comprueba_formulario_inscripcion(f) {
    if (comprueba_mail(f)) {
        var error_pwd = check_password(f);
        if (error_pwd == 0) {
            return true;
        } else if (error_pwd == -1) {
            alert("Las contraseñas no coinciden.");
        } else if (error_pwd == -2) {
            alert("La contraseña tiene que contener al menos 8 caracteres.");
        }
    } else {
        alert("ERROR: Email incorrecto. Inténtelo de nuevo.");
    }
    return false;
}

function comprueba_mail(f) {
    var re = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!re.test(f.mail.value)) {
        return false;
    }
    return true;
}

function check_password(f) {
    var password1 = f.password.value;
    var password2 = f.confirmar_password.value;
    if (password1 != password2) {
        return -1;
    }
    if (password1.length < 8) {
        return -2;
    }
    return 0;
}

function validar_usuario(select) {
    var universidad = document.getElementById("universidad");
    //2 -> profesor / 3-> Estudiante
    if (select.value == "2" || select.value == "3") {
        universidad.hidden = false;
    } else {
        universidad.hidden = true;
    }
    actualizar_actividades(select.value);
    actualizar_precio();
}

function actualizar_actividades(usuario) {
//    var act_incluidas_1 = [];
    var act_incluidas_2 = ["act_3"];
//    var act_incluidas_3 = [];

    var actividad;
    for (var i = 1; i <= 3; i++) {
        actividad = document.getElementById("act_" + i);
        actividad.checked = false;
        actividad.disabled = false;
    }

    if (usuario == 2) {
        for (var i = 0; i < act_incluidas_2.length; i++) {
            actividad = document.getElementById(act_incluidas_2[i]);
            actividad.checked = true;
            actividad.disabled = true;
        }
    }
}

function calcular_precio_actividades_cuota() {
    var precio;

    var usuario = document.getElementById("cuota").value;
    if (usuario == "1") {//Invitado
        precio = 50;
    } else if (usuario == "2") { // Profesor
        precio = 45;
    } else if (usuario == "3") { // Estudiante
        precio = 25;
    }

    var precio_actividades = [25, 15, 30];
    var actividad;
    for (var i = 1; i <= 3; i++) {
        actividad = document.getElementById("act_" + i);
        if (actividad.checked && !actividad.disabled) {
            precio += precio_actividades[i - 1];
        }
    }
    return precio;
}

function actualizar_precio() {
    var precio = calcular_precio_actividades_cuota();
    document.getElementById("precio").innerHTML = "Precio Total: " + precio + "€";
}

function activar_paso1() {
    document.getElementById('div_datos_personales').hidden = false;
    document.getElementById('div_cuotas_actividades').hidden = true;
    document.getElementById('div_alojamiento').hidden = true;
    document.getElementById('precio').hidden = true;
}

function activar_paso2() {
    document.getElementById('div_datos_personales').hidden = true;
    document.getElementById('div_cuotas_actividades').hidden = false;
    document.getElementById('div_alojamiento').hidden = true;
    document.getElementById('precio').hidden = false;
}

function activar_paso3() {
    document.getElementById('div_datos_personales').hidden = true;
    document.getElementById('div_cuotas_actividades').hidden = true;
    document.getElementById('div_alojamiento').hidden = false;
}

function check_activar_paso2() {
    var correcto = true;
    var formulario = document.getElementById("id_formulario_inscripcion");
    var div_error = document.getElementById("div_error_inscripcion");
    var mensaje_error = "";
    if (formulario.nombre.value == "") {
        mensaje_error += "Falta completar el nombre.<br>";
        correcto = false;
    }
    if (formulario.apellidos.value == "") {
        mensaje_error += "Falta completar los apellidos.<br>";
        correcto = false;
    }
    if (formulario.telefono.value == "") {
        mensaje_error += "Falta completar el teléfono.<br>";
        correcto = false;
    }
    if (formulario.mail.value == "") {
        mensaje_error += "Falta completar el email.<br>";
        correcto = false;
    }else if(!comprueba_mail(formulario)){
        mensaje_error += "El email es incorrecto.<br>";
        correcto = false;
    }
    var error_pwd = check_password(formulario);
    if(error_pwd == -1){
        mensaje_error += "Las contraseñas no coinciden.<br>";
        correcto = false;
    }else if(error_pwd == -2){
        mensaje_error += "La contraseña tiene que tener al menos 8 caracteres.<br>";
        correcto = false;
    }
    div_error.innerHTML = mensaje_error;
//    if (correcto) {
        activar_paso2();
//    }
}

function check_activar_paso3() {
    var correcto = true;
    var formulario = document.getElementById("id_formulario_inscripcion");
    var div_error = document.getElementById("div_error_inscripcion");
    var mensaje_error = "";
    var usuario = document.getElementById("cuota").value;
    if (usuario == "2" || usuario == "3") {
        if(formulario.universidad.value == ""){
            mensaje_error = "Falta rellenar la universidad a la que pertenece."
            correcto = false;
        }
    }
    div_error.innerHTML = mensaje_error;
    if (correcto) {
        activar_paso3();
    }
}

function mostrar_hoteles(checkbox) {
    document.getElementById("datos_hotel").hidden = !checkbox.checked;
    if(!checkbox.checked){
        actualizar_precio();
    }
    var habitaciones = document.getElementsByName("habitacion");
    for(var i=0; i<habitaciones.length; i++){
        habitaciones[i].checked = false;
    }
}

function sumar_precio_hotel(precio_hotel) {
    var precio = calcular_precio_actividades_cuota();
    precio += precio_hotel;
    document.getElementById("precio").innerHTML = "Precio Total: " + precio + "€";
}