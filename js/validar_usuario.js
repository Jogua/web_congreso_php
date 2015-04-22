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