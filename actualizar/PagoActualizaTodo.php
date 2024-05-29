<?php
// Conexión a la base de datos
include '../principal/conexion_bd.php';
$resultado = $conexion->query("SELECT * FROM pagos");

// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
    foreach ($_POST['id_pago'] as $ids => $id_pago) {
        $editidpago = mysqli_real_escape_string($conexion, $_POST['id_pago'][$ids]);
        $editorden = mysqli_real_escape_string($conexion, $_POST['no_orden'][$ids]);
        $editcan = mysqli_real_escape_string($conexion, $_POST['Cantidad_reparada'][$ids]);
        $editdetalle = mysqli_real_escape_string($conexion, $_POST['detalles_reparacion'][$ids]);
        $editfecha = mysqli_real_escape_string($conexion, $_POST['Fecha_pago'][$ids]);
        $edithora = mysqli_real_escape_string($conexion, $_POST['Hora_pago'][$ids]);
        $editprecio = mysqli_real_escape_string($conexion, $_POST['precio'][$ids]);

        $actualizar = $conexion->query("UPDATE pagos SET 
            id_pago = '$editidpago', 
            no_orden = '$editorden', 
            Cantidad_reparada = '$editcan', 
            detalles_reparacion = '$editdetalle', 
            Fecha_pago = '$editfecha', 
            Hora_pago = '$edithora', 
            precio = '$editprecio' 
            WHERE id_pago = '$editidpago'");

echo "<script>alert('Datos actualizados.'); window.location.href = 'PagoActualizarFormulario.php';</script>";
}
    $resultado = $conexion->query("SELECT * FROM pagos");
}

while ($fila = $resultado->fetch_assoc()) {
    // Formulario de actualización para cada fila
    echo '<tr>
                <td><input type="text" readonly name="id_pago['.$fila['id_pago'].']" value="'.$fila['id_pago'].'" class="campoActualiza"/></td>
                <td><input type="text" name="no_orden['.$fila['id_pago'].']" value="'.$fila['no_orden'].'" class="campoActualiza"/></td>
                <td><input type="text" name="Cantidad_reparada['.$fila['id_pago'].']" value="'.$fila['Cantidad_reparada'].'" class="campoActualiza"/></td>
                <td><input type="text" name="detalles_reparacion['.$fila['id_pago'].']" value="'.$fila['detalles_reparacion'].'" class="campoActualiza"/></td>
                <td><input type="text" name="Fecha_pago['.$fila['id_pago'].']" value="'.$fila['Fecha_pago'].'" class="campoActualiza"/></td>
                <td><input type="text" name="Hora_pago['.$fila['id_pago'].']" value="'.$fila['Hora_pago'].'" class="campoActualiza"/></td>
                <td><input type="text" name="precio['.$fila['id_pago'].']" value="'.$fila['precio'].'" class="campoActualiza"/></td>
                <td><input type="submit" name="actualizar" value="Actualizar" class="campo"></td>
          </tr>';
}
?>
