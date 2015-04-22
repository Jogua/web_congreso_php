function actualizar_precio() {
    var precio;
    
    var usuario = document.getElementById("tipoUsuario").value;
    if(usuario == "estudiante"){
        precio = 15;
    }else if(usuario == "profesor"){
        precio = 20;
    }else{
        precio = 30;
    }
    
    var alhambra = document.getElementById("alhambra");
    if(alhambra.checked){
        precio += 15;
    }
    
    var sierra = document.getElementById("sierra");
    if(sierra.checked){
        precio += 20;
    }
    
    document.getElementById("precio").innerHTML = "Precio Total: " + precio + "€";
}