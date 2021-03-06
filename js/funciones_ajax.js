function cambiar_actividades_cuota(id_cuota) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("actividades_por_cuotas").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "php/cambiar_actividades_cuota.php?id=" + id_cuota, true);
    xmlhttp.send();
    cambiar_precio_cuota(id_cuota);
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

var precio_inscripcion = 50;
var precio_actividades = 0;
var precio_alojamiento = 0;

function actualizar_precio_pantalla() {
    document.getElementById("precio").innerHTML = "-- Precios -- <br><br> Congreso: <br>" + precio_inscripcion + " € <br><br> Actividades: <br>"
            + precio_actividades + " € <br><br> Alojamiento: <br>" + precio_alojamiento + " € <br><br>"
            + "Total: <br> " + (precio_inscripcion + precio_actividades + precio_alojamiento) + " €";
}

function cambiar_precio_cuota(id_cuota) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            precio_inscripcion = parseInt(xmlhttp.responseText);
            precio_actividades = 0;
            actualizar_precio_pantalla();
        }
    };
    xmlhttp.open("GET", "php/obtener_precio.php?cuota=" + id_cuota, true);
    xmlhttp.send();
}

function cambiar_precio_actividades(checkbox, id_actividad) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (checkbox.checked) {
                precio_actividades += parseInt(xmlhttp.responseText);
            } else {
                precio_actividades -= parseInt(xmlhttp.responseText);
            }
            actualizar_precio_pantalla();
        }
    };
    xmlhttp.open("GET", "php/obtener_precio.php?actividad=" + id_actividad, true);
    xmlhttp.send();
}

function cambiar_precio_alojamiento(precio) {
    precio_alojamiento = precio;
    actualizar_precio_pantalla();
}


function actualizar_congresistas(apellidos) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("busqueda_congresistas").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "php/actualizar_congresistas.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var parametros = "apellidos=" + apellidos;
    xmlhttp.send(parametros);
}
