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

function pedir_informacion_hotel(checkbox){
//    alert(checkbox.checked);
    var datos = "";
    if(checkbox.checked){
        datos = '<ul>' +
            '<li>' +
                '<label for="fecha_entrada">Fecha de Entrada: </label>' +
                '<input type="date" id="fecha_entrada" name="fecha_entrada" onchange="verificar_fecha_entrada(this)" required/>' +
            '</li>' +
            '<li>' +
                '<label for="fecha_salida">Fecha de Salida: </label>' +
                '<input type="date" id="fecha_salida" name="fecha_salida" onchange="verificar_fecha_salida(this)" required/>' +
            '</li>' +
            '<li>' +
                '<label for="n_habitaciones">Nº de habitaciones: </label>' +
                '<input type="number" min=1 max=10 value="1" name="n_habitaciones" required/>' +
            '</li>' +
            '<li>' +
                '<label for="n_huespedes">Huespedes/Habitación: </label>' +
                '<input type="number" min=1 max=10 value="2" name="n_huespedes" required/>' +
            '</li>' +
        '</ul>';
    }
    document.getElementById("datos_hotel").innerHTML = datos;
}

function pedir_informacion_hotel2(checkbox){
    pedir_informacion_hotel(checkbox);
    var boton = document.getElementById("boton_reserva_hotel");
    if(checkbox.checked){
        boton.hidden = false;
    }else{
        boton.hidden = true;
    }
}


function verificar_fecha_entrada(fecha) {
    var fecha_actual = new Date();
    var fecha_entrada = new Date(fecha.value);
    if (fecha_entrada < fecha_actual) {
        alert("La fecha tiene que ser posterior a hoy");
        cambiar_un_dia_mas("fecha_entrada", fecha_actual);
        cambiar_un_dia_mas("fecha_salida", new Date(fecha.value));
    }else{
        var fecha_salida_value = document.getElementById("fecha_salida").value;
        if (fecha_salida_value !== "") {
            var fecha_salida = new Date(fecha_salida_value);
            if (fecha_entrada >= fecha_salida) {
                cambiar_un_dia_mas("fecha_salida", fecha_entrada);
            }
        } else {
            cambiar_un_dia_mas("fecha_salida", fecha_entrada);
        }
    }
}

function verificar_fecha_salida(fecha) {
    var fecha_entrada = document.getElementById("fecha_entrada");
    var fecha_entrada_date = new Date(fecha_entrada.value);
    var fecha_introducida = new Date(fecha.value);
    if (fecha_introducida < fecha_entrada_date) {
        alert("La fecha tiene que ser posterior a la de entrada");
        cambiar_un_dia_mas("fecha_salida", fecha_entrada_date);
    } else if (fecha.value == "") {
        cambiar_un_dia_mas("fecha_salida", fecha_introducida);
    }
}

function cambiar_un_dia_mas(fecha_a_cambiar, fecha_actual) {
    var next_day = fecha_actual;
    next_day.setDate(fecha_actual.getDate() + 1);

    var next_day_str = next_day.getFullYear() + "-";
    if (next_day.getMonth() + 1 < 10) {
        next_day_str += "0";
    }
    next_day_str += (next_day.getMonth() + 1) + "-";
    if (next_day.getDate() < 10) {
        next_day_str += "0";
    }
    next_day_str += next_day.getDate();
    document.getElementById(fecha_a_cambiar).value = next_day_str;
}