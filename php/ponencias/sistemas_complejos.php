<?php

if ($id == 16) {
    echo " <p> <strong>Programación Paralela,</strong> <i>por J.M. Mantas</i> </p>";
    echo " <p>La Programación Paralela considera aspectos conceptuales y las particularidades "
    . "físicas de la computación paralela.  </p>";
    echo " <p>Computación Paralela: Uso de varios procesadores trabajando juntos para resolver una tarea común:  </p>";
    echo " <p><ul><li>Cada procesador trabaja en una porción del problema.</li>"
    . "<li>Los procesos pueden intercambiar datos, a través de la direcciones de "
    . "memoria compartidas o mediante una red de interconexión </li></p>";
} else if ($id == 17) {
    echo " <p> <strong>Sistemas Distribuidos,</strong> <i>por J.L. Garrido</i> </p>";
    echo " <p>Un sistema distribuido se define como una colección de computadoras separadas físicamente y conectadas "
    . "entre sí por una red de comunicaciones; cada máquina posee sus componentes de hardware y software que el programador "
    . "percibe como un solo sistema (no necesita saber qué cosas están en qué máquinas). El programador accede a los componentes "
    . "de software (objetos) remotos, de la misma manera en que accedería a componentes locales, en un grupo de computadoras "
    . "que usan un middleware entre los que destacan (RPC) y SOAP para conseguir un objetivo.  </p>";
    echo " <p> Los sistemas distribuidos deben ser muy confiables, ya que si un componente del sistema se descompone otro componente debe "
    . "ser capaz de reemplazarlo. Esto se denomina tolerancia a fallos.  </p>";
} else if ($id == 18) {
    echo " <p> <strong>Sistemas en Tiempo Real,</strong> <i>por J.A. Holgado</i> </p>";
    echo " <p>Un sistema de tiempo real es un sistema informático que interacciona con su entorno físico y responde a los estímulos "
    . "del entorno dentro de un plazo de tiempo determinado. No basta con que las acciones del sistema sean correctas, sino que, "
    . "además, tienen que ejecutarse dentro de un intervalo de tiempo determinado.  </p>";
    echo " <p>Existen sistemas de tiempo real crítico (tiempo real duro), en los que los plazos de respuesta deben respetarse "
    . "siempre estrictamente y una sola respuesta tardía a un suceso externo puede tener consecuencias fatales; y sistemas de "
    . "tiempo real acrítico (tiempo real suave), en los que se pueden tolerar retrasos ocasionales en la respuesta a un suceso.  </p>";
}
?>