<?php
include_once 'conexion_bd.php';
?>

<h2>Inscripción</h2>
<p>
    El pago de la inscripción se realizará mediante transferencia bancaria. Cuando se inscriba recibirá un email
    con la forma de pago y los datos necesarios para realizarlo.
</p>
<p>
    ¿Quieres asistir a la primera edición del CEIIE? Rellena el siguiente formulario.
</p>
<form class="formularioInscripcion" method="post" action="php/enviar_inscripcion.php" onsubmit="return comprueba_formulario(this)">
    <ul>
        <li>
            <label for="nombre"> Nombre: </label>
            <input type="text" name="nombre" required />
        </li>
        <li>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required />
        </li>
        <li>
            <label for="telefono">Telefono:</label>
            <input type="text" name="telefono" required />
        </li>
        <li>
            <label for="mail">E-mail:</label>
            <input type="email" name="mail" required />
        </li>
        <li>
            <label for="password"> Contraseña:</label>
            <input type="password" name="password" required/>
        </li>
        <li>
            <label for="confirmar_password"> Confirma la contraseña:</label>
            <input type="password" name="confirmar_password" required/>
        </li>
        <li>
            <label for="cuota"> Cuota de inscripción:</label>
            <select id="cuota" name="cuota" onchange="validar_usuario(this)">
                <?php
                $consulta_cuotas = "SELECT * FROM cuota";
                $resultado_cuotas = conexionBD($consulta_cuotas);
                if ($resultado_cuotas) {
                    while ($fila = mysql_fetch_array($resultado_cuotas)) {
                        echo '<option value="' . $fila['id_cuota'] . '" title="' . $fila['descripcion'] . '">'
                        . $fila['nombre_cuota'] . ' -> (' . $fila['importe'] . ' €)</option>';
                    }
                }
                ?>
            </select>	    
        </li>
        <li id="universidad">

        </li>
        <li>
            <label for="actividades">Actividades:</label>

            <ul class="inscripcion_checkbox">
                <?php
                $consulta_actividades = "SELECT id_actividad, nombre_actividad, importe FROM actividad";
                $resultado_actividades = conexionBD($consulta_actividades);
                echo '<br>';
                if ($resultado_actividades) {
                    while ($fila = mysql_fetch_array($resultado_actividades)) {
                        echo '<li>';
                        echo '<input id="act_' . $fila['id_actividad'] . '" type="checkbox" name="actividades[]" value=' . $fila['id_actividad'] . ' onchange="actualizar_precio()" />';
                        echo '<label for="act_' . $fila['id_actividad'] . '"> ' . $fila['nombre_actividad'] . " (" . $fila['importe'] . " €)" .'</label>';
                        echo '</li>';
                    }
                }
                ?>

            </ul>
        </li>
        <li>
            <label for="actividades">Reserva de Hotel:</label>
            <br>
            <ul class="inscripcion_checkbox">
                <li>
                    <input type="checkbox" id="hotel" name="hotel" onchange="pedir_informacion_hotel(this)"/>
                    <label for="hotel">¿Quieres reservar un Hotel?</label>
                </li>
            </ul>
            <br>
            <div id="datos_hotel">
                
            </div>
        </li>
        <li id="precio">
            Precio Total: 50€ 
        </li>
        <li>
            <button class="submit" type="submit">Inscribirse</button>
        </li>
    </ul>
</form>