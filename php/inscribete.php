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
<div id="div_error_inscripcion" >
</div>
<form class="formularioInscripcion" id="id_formulario_inscripcion" method="post" action="php/enviar_inscripcion.php" onsubmit="return comprueba_formulario_inscripcion(this)">
    <div id="div_datos_personales">
        <h3>1/3 Datos Personales</h3>
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
                <button type="button" class="submit" onclick="check_activar_paso2()">Siguiente</button>
            </li>
        </ul>
    </div>
    <div id="div_cuotas_actividades" hidden>
        <h3>2/3 Cuotas y Actividades</h3>
        <ul>
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
            <li id="universidad" hidden>
                <label for="universidad"> Universidad:</label>
                <input type="text" name="universidad"/>
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
                            echo '<label for="act_' . $fila['id_actividad'] . '"> ' . $fila['nombre_actividad'] . " (" . $fila['importe'] . " €)" . '</label>';
                            echo '</li>';
                        }
                    }
                    ?>

                </ul>
            </li>
            <li>
                <button type="button" class="submit" onclick="activar_paso1()">Anterior</button>
                <button type="button" class="submit secundario" onclick="check_activar_paso3()">Siguiente</button>
            </li>
        </ul>
    </div>
    <div id="div_alojamiento" hidden>
        <h3>3/3 Reserva de Alojamiento</h3>
        <ul>
            <li>
                <label for="actividades">Reserva de Hotel:</label>
                <br>
                <ul class="inscripcion_checkbox">
                    <li>
                        <input type="checkbox" id="hotel" name="hotel" onchange="mostrar_hoteles(this)"/>
                        <label for="hotel">¿Quieres reservar un Hotel?</label>
                    </li>
                </ul>
                <br>
                <div id="datos_hotel" hidden>
                    <h3>Reserva desde el 01/06/2015 al 03/06/2015</h3>
                    <?php
                    include 'hoteles.php';
                    ?>
                </div>
            </li>
            <li>
                <button type="button" class="submit" onclick="activar_paso2()">Anterior</button>
                <button type="submit" class="submit secundario">Finalizar</button>
            </li>
        </ul>
    </div>
    <ul>
        <li id="precio" hidden>
            Precio Total: 50€ 
        </li>
    </ul>
</form>