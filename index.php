<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>I Edición CEIIE | Granada, 1-3 Julio</title>
        <!-- script para slider de patrocinadores -->
        <script src="js/slider.js"></script>
        <script src="js/formularios.js"></script>  
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <?php
        include './php/conexion_BD.php';
        ?>
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
            </header>
            <br class="clearfloat" />
            <div class="barraDerecha">
                <?php
                if ($seccion == "detalle_ponencia") {
                    $id = $_GET["id"];
                } else {
                    $id = 0;
                }
                include './php/contexmenu.php';                
                ?>
            </div>
            <div class="mainContent">
                <?php
                include './php/content.php';
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
