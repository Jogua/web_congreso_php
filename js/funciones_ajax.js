function cambiar_actividades_cuota(id_cuota) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("actividades_por_cuotas").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "php/cambiar_actividades_cuota.php?id=" + id_cuota, true);
    xmlhttp.send();
}

function activar_foto(id_actividad) {
    var div_actividad = document.getElementById("foto_actividad_" + id_actividad);
    if (div_actividad.hidden) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                div_actividad.innerHTML = xmlhttp.responseText;
                div_actividad.hidden = false;
            }
        };
        xmlhttp.open("GET", "php/activar_foto.php?id=" + id_actividad, true);
        xmlhttp.send();
    } else {
        div_actividad.innerHTML = "";
        div_actividad.hidden = true;
    }
}


//function calcular_precio_actividades_cuota() {
//    var precio;
//
//    var usuario = document.getElementById("cuota").value;
//    if (usuario == "1") {//Invitado
//        precio = 50;
//    } else if (usuario == "2") { // Profesor
//        precio = 45;
//    } else if (usuario == "3") { // Estudiante
//        precio = 25;
//    }
//
//    var precio_actividades = [25, 15, 30];
//    var actividad;
//    for (var i = 1; i <= 3; i++) {
//        actividad = document.getElementById("act_" + i);
//        if (actividad.checked && !actividad.disabled) {
//            precio += precio_actividades[i - 1];
//        }
//    }
//    return precio;
//}
//
//function actualizar_precio() {
//    var precio = calcular_precio_actividades_cuota();
//    document.getElementById("precio").innerHTML = "Precio Total: " + precio + "€";
//}

function calcular_precio_congreso(){
    
}

function calcular_precio_alojamiento(){
    
}

function actualizar_precio_total(){
    
}