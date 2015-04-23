function check_password() {
    var password1 = document.getElementsByName("contrasena").item(0).value;
    var password2 = document.getElementsByName("contrasena2").item(0).value;

    if (password1 != password2) {
        alert("Las contraseñas no coinciden.");
    }else if (strlen(password1)<8){
        alert("La contraseña tiene que contener al menos 8 caracteres.");
    }
}