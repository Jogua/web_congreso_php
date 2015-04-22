<?php
if ($id == 7) {
    echo " <p> <strong>Bases de Datos Multidimensionales,</strong> <i>por E. Garví</i> </p>";
    echo " <p>Las bases de datos multidimensionales se utilizan principalmente para crear aplicaciones OLAP y "
    . "pueden verse como bases de datos de una sola tabla, su peculiaridad es que por cada dimensión tienen un campo (o columna), "
    . "y otro campo por cada métrica o hecho, es decir estas tablas almacenan registros cuyos campos son de la forma:  </p>";
    echo " <p>(d1, d2, d3, ..., f1, f2, f3, ...)  </p>";
    echo " <p>Donde los campos '{di}' hacen referencia a las dimensiones de la tabla, y los campos '{fi}' a las métricas o hechos "
    . "que se quiere almacenar, estudiar o analizar.  </p>";
    echo " <p>Lo más importante a tener en cuenta para implementar esta estructura de datos es que la tabla contiene todas las n-tuplas, "
    . "con los valores de las dimensiones, o índice del cubo, y los valores de las métricas previamente calculados para el cruce "
    . "de valores del índice en cuestión.  </p>";
} else if ($id == 8) {
    echo " <p> <strong>Bases de Datos Orientadas a Objetos,</strong> <i>por J. Samos</i> </p>";
    echo " <p>En una base de datos orientada a objetos, la información se representa mediante objetos como los presentes en la programación "
    . "orientada a objetos. Cuando se integra las características de una base de datos con las de un lenguaje de programación orientado a "
    . "objetos, el resultado es un sistema gestor de base de datos orientada a objetos (ODBMS, object database management system). Un ODBMS "
    . "hace que los objetos de la base de datos aparezcan como objetos de un lenguaje de programación en uno o más lenguajes de programación "
    . "a los que dé soporte. Un ODBMS extiende los lenguajes con datos persistentes de forma transparente, control de concurrencia, "
    . "recuperación de datos, consultas asociativas y otras capacidades.  </p>";
    echo " <p>Los ODBMS son una buena elección para aquellos sistemas que necesitan un buen rendimiento en la manipulación de tipos de dato complejos.  </p>";
    echo " <p>Los ODBMS proporcionan los costes de desarrollo más bajos y el mejor rendimiento cuando se usan objetos gracias a que almacenan objetos en disco "
    . "y tienen una integración transparente con el programa escrito en un lenguaje de programación orientado a objetos, al almacenar exactamente el modelo "
    . "de objeto usado a nivel aplicativo, lo que reduce los costes de desarrollo y mantenimiento.  </p>";
} else if ($id == 9) {
    echo " <p> <strong>Bases de Datos Distribuidas,</strong> <i>por C. Delgado</i> </p>";
    echo " <p>Una base de datos distribuida (BDD) es un conjunto de múltiples bases de datos lógicamente relacionadas las cuales se encuentran distribuidas en "
    . "diferentes espacios lógicos (pej. un servidor corriendo 2 máquinas virtuales) e interconectados por una red de comunicaciones. Dichas BDD tienen la "
    . "capacidad de realizar procesamiento autónomo, esto permite realizar operaciones locales o distribuidas. Un sistema de Bases de Datos Distribuida (SBDD) "
    . "es un sistema en el cual múltiples sitios de bases de datos están ligados por un sistema de comunicaciones de tal forma que, un usuario en "
    . "cualquier sitio puede acceder los datos en cualquier parte de la red exactamente como si estos fueran accedidos de forma local.  </p>";
    echo " <p>Un sistema distribuido de bases de datos se almacenan en varias computadoras. Los principales factores que distinguen un SBDD de un sistema "
    . "centralizado son los siguientes:  </p>";
    echo " <p><ul><li>Hay múltiples computadores, llamados sitios o nodos.</li>  ";
    echo " <li>Estos sitios deben de estar comunicados por medio de algún tipo de red de comunicaciones para transmitir datos y órdenes entre los sitios.</li></ul></p>";
}
?>