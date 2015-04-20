<?php
if ($id != 0) {
    ?>
    <h2> Ponencias Relacionadas </h2>
    <?php
    if ($id == 1) {
        ?>
        <ul class="otrasPonencias">
            <a href="index.php?seccion=detalle_ponencia&&id=2"><li>IFML</li></a>
            <a href="index.php?seccion=detalle_ponencia&&id=3"><li>Prince2</li></a>
        </ul>
        <?php
    }else if ($id == 2) {
        ?>
        <ul class="otrasPonencias">
            <a href="index.php?seccion=detalle_ponencia&&id=1"><li>Metodologías Ágiles</li></a>
            <a href="index.php?seccion=detalle_ponencia&&id=3"><li>Prince2</li></a>
        </ul>
        <?php
    } else if ($id == 3) {
        ?>
        <ul class="otrasPonencias">
            <a href="index.php?seccion=detalle_ponencia&&id=1"><li>Metodologías Ágiles</li></a>
            <a href="index.php?seccion=detalle_ponencia&&id=2"><li>IFML</li></a>
        </ul>
        <?php
    }
}
?>
