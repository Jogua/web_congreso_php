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
                <h1>I Congreso de Estudiantes de Ingeniería Informática en España</h1>
                <div id="menuSuperior">
                    <?php
                    include './php/header.php';
                    ?>
                </div>
            </header>
            <div class="barraDerecha">
                <?php
                include './php/contexmenu.php';
                include './html/slider_patrocinadores.html';
                ?>
            </div>
            <div class="mainContent">
                <?php
//                echo $HTTP_GET_VARS["seccion"];
//                $parametro1=$_GET['seccion'];
                if (empty($_GET['seccion'])) {
                    $seccion = "presentacion";
                } else {
                    $seccion = $_GET['seccion'];
                }
                $direccion = './html/' . $seccion . '.html';
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
