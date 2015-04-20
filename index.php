<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>I Edición CEIIE | Granada, 1-3 Julio</title>
        <!-- script para slider de patrocinadores -->
        <script src="js/slider.js"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container">
            <header>
                <img src="images/cabecera.png" alt="Logo Congreso" />
                <div id="menuSuperior">
                    <?php
                    if (empty($_GET['seccion'])) {
                        $seccion = "presentacion";
                    } else {
                        $seccion = $_GET['seccion'];
                    }
                    include './php/header.php';
                    ?>
                </div>
                <br class="clearfloat" />
            </header>
            <div class="barraDerecha">
                <?php
                if($seccion == "detalle_ponencia"){
                    $id = $_GET["id"];
                }else{
                    $id = 0;
                }
                include './php/contexmenu.php';
                include './html/slider_patrocinadores.html';
                ?>
            </div>
            <div class="mainContent">
                <?php
                if($seccion == "detalle_ponencia"){ // el ide lo guarda en la parte de la barraDerecha
                    $direccion = './php/detalle_ponencia.php';
                }else if ($seccion == "detalle_visita") {
                    $visita = $_GET["visita"];
                    $direccion = './php/detalle_visita.php';
                } else {
                    $direccion = './html/' . $seccion . '.html';
                }

//                echo "El Primer Parametro es :" . $seccion . "<br />";
//                $direccion = $HTTP_GET_VARS["seccion"];
                include $direccion;
                ?>
            </div>
            <br class="clearfloat" />
            <footer>
                <?php
                include './php/footer.php';
                ?>
            </footer>
        </div>

    </body>
</html>
