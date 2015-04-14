var i = 0;
var ruta_slider1 = new Array();
var ruta_slider2 = new Array();

ruta_slider1[0] = "images/sap.png";
ruta_slider1[1] = "images/samsung.png";
ruta_slider1[2] = "images/sony.png";

ruta_slider2[0] = "images/google.png";
ruta_slider2[1] = "images/oracle.png";
ruta_slider2[2] = "images/microsoft.png";

function cambiarImagen()
{
    document.slide.src = ruta_slider1[i];
    document.slide2.src = ruta_slider2[i];

    if (i < ruta_slider1.length - 1)
        i++;
    else
        i = 0;
    setTimeout("cambiarImagen()", 3000);
}
window.onload = cambiarImagen;