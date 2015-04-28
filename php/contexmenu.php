<?php
if ($id != 0) {
    if ($id >= 1 && $id <= 3) {
        ?>
        <h2> Ponencias Relacionadas con Ing. SoftWare</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 1) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=1"><li>Metodologías Ágiles</li></a>';
            }
            if ($id != 2) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=2"><li>IFML</li></a>';
            }
            if ($id != 3) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=3"><li>Prince2</li></a>';
            }
            ?>
        </ul>
        <?php
    } else if ($id >= 4 && $id <= 6) {
        ?>
        <h2> Ponencias Relacionadas con Informática Gráfica</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 4) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=4"><li>Visualización y Realismo</li></a>';
            }
            if ($id != 5) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=5"><li>Digitalización 3D</li></a>';
            }
            if ($id != 6) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=6"><li>Realidad Aumentada</li></a>';
            }
            ?>
        </ul>
        <?php
    } else if ($id >= 7 && $id <= 9) {
        ?>
        <h2> Ponencias Relacionadas con Base de Datos</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 7) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=7"><li>Bases de Datos Multidimensionales</li></a>';
            }
            if ($id != 8) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=8"><li>Bases de Datos Orientadas a Objetos</li></a>';
            }
            if ($id != 9) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=9"><li>Bases de Datos Distribuidas</li></a>';
            }
            ?>
        </ul>
        <?php
    } else if ($id >= 10 && $id <= 12) {
        ?>
        <h2> Ponencias Relacionadas con Compiladores</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 10) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=10"><li>Procesadores de Lenguajes</li></a>';
            }
            if ($id != 11) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=11"><li>Traductores</li></a>';
            }
            if ($id != 12) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=12"><li>Procesamiento de Habla</li></a>';
            }
            ?>
        </ul>
        <?php
    } else if ($id >= 13 && $id <= 15) {
        ?>
        <h2> Ponencias Relacionadas con Sistemas Operativos</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 13) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=13"><li>Sistemas Windows</li></a>';
            }
            if ($id != 14) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=14"><li>Sistemas Unix/Linux</li></a>';
            }
            if ($id != 15) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=15"><li>Sistemas iOS/Mac</li></a>';
            }
            ?>
        </ul>
        <?php
    } else if ($id >= 16 && $id <= 18) {
        ?>
        <h2> Ponencias Relacionadas con Sistemas Complejos</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 16) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=16"><li>Programación Paralela</li></a>';
            }
            if ($id != 17) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=17"><li>Sistemas Distribuidos</li></a>';
            }
            if ($id != 18) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=18"><li>Sistemas en Tiempo Real</li></a>';
            }
            ?>
        </ul>
        <?php
    } else if ($id >= 19 && $id <= 21) {
        ?>
        <h2> Ponencias Relacionadas con Interfaces de Usuario</h2>
        <ul class="ponenciasRelacionadas">
            <?php
            if ($id != 19) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=19"><li>Interacción Háptica</li></a>';
            }
            if ($id != 20) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=20"><li>Wearables</li></a>';
            }
            if ($id != 21) {
                echo '<a href="index.php?seccion=detalle_ponencia&id=21"><li>Realidad Virtual</li></a>';
            }
            ?>
        </ul>
        <?php
    }
}
?>
