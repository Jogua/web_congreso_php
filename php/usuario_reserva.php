<?php

echo "<script>
            location.href='../index.php?seccion=hoteles&ini=" . $_POST['fecha_entrada'] . "&fin=" . $_POST['fecha_salida']
 . "&hab=" . $_POST['n_habitaciones'] . "&hues=" . $_POST['n_huespedes'] . "';" .
 "</script>";
?>