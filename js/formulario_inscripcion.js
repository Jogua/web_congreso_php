function check_password(f) {

    var password1 = f.contrasena.value;
    var password2 = f.contrasena2.value;
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
    if (select.value == "estudiante" || select.value == "profesor") {
        document.getElementById("universidad").innerHTML = "<li>" +
                " <label for=\"universidad\"> Universidad:</label> " +
                " <input type=\"text\" name=\"universidad\" required/> " +
                "</li>";
    } else {
        document.getElementById("universidad").innerHTML = "";
    }
    actualizar_precio();
}

function actualizar_precio() {
    var precio;

    var usuario = document.getElementById("tipoUsuario").value;
    if (usuario == "estudiante") {
        precio = 15;
    } else if (usuario == "profesor") {
        precio = 20;
    } else {
        precio = 30;
    }

    var alhambra = document.getElementById("alhambra");
    if (alhambra.checked) {
        precio += 15;
    }

    var sierra = document.getElementById("sierra");
    if (sierra.checked) {
        precio += 20;
    }

    document.getElementById("precio").innerHTML = "Precio Total: " + precio + "€";
}