<?php
// Conexión a la base de datos
include '../principal/conexion_bd.php';
$resultado = $conexion->query("SELECT * FROM pagos");
// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
foreach ($_POST['id_pago'] as $ids){

    $editidpago=mysqli_real_escape_string($conexion, $_POST['id_pago'][$ids]);
    $editorden=mysqli_real_escape_string($conexion, $_POST['no_orden'][$ids]);
    $editidcli=mysqli_real_escape_string($conexion, $_POST['Id_cliente'][$ids]);
    $editnomcli=mysqli_real_escape_string($conexion, $_POST['Nombre_cliente'][$ids]);
    $editdis=mysqli_real_escape_string($conexion, $_POST['Dispositivos'][$ids]);
    $editcan=mysqli_real_escape_string($conexion, $_POST['Cantidad_reparada'][$ids]);
    $editdetalle=mysqli_real_escape_string($conexion, $_POST['detalles_reparacion'][$ids]);
    $editfecha=mysqli_real_escape_string($conexion, $_POST['Fecha_pago'][$ids]);
    $edithora=mysqli_real_escape_string($conexion, $_POST['Hora_pago'][$ids]);
    $editprecio=mysqli_real_escape_string($conexion, $_POST['precio'][$ids]);
    $edittotal=mysqli_real_escape_string($conexion, $_POST['total'][$ids]);



    $actualizar=$conexion->query("UPDATE pagos SET id_pago ='$editidpago', no_orden='$editorden', Id_cliente='$editidcli', Nombre_cliente='$rditnomcli', Dispositivos='$editdis', Cantidad_reparada='$editcan', detalles_reparacion='$editdetalle', Fecha_pago='$editfecha', Hora_pago='$edithora', precio='$editprecio', total='$edittotal' WHERE id_pago='$idpago'");
    echo "<script>alert('Datos actualizados.');</script>";
}
$resultado = $conexion->query("SELECT * FROM pagos");
}

    while ($fila = $resultado->fetch_assoc()) {
        // Formulario de actualización para cada fila
        echo '<tr>
                    <td><input type="text" readonly name="id_pago['.$fila['id_pago'].']" value="'.$fila['id_pago'].'"  class="campoActualiza"/></td>
                    <td><input type="text" name="no_orden['.$fila['id_pago'].']" value = "'.$fila['no_orden'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Id_cliente['.$fila['id_pago'].']" value = "'.$fila['Id_cliente'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Nombre_cliente['.$fila['id_pago'].']" value = "'.$fila['Nombre_cliente'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Dispositivos['.$fila['id_pago'].']" value = "'.$fila['Dispositivos'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Cantidad_reparada['.$fila['id_pago'].']" value = "'.$fila['Cantidad_reparada'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="detalles_reparacion['.$fila['id_pago'].']" value = "'.$fila['detalles_reparacion'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Fecha_pago['.$fila['id_pago'].']" value = "'.$fila['Fecha_pago'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Hora_pago['.$fila['id_pago'].']" value = "'.$fila['Hora_pago'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="precio['.$fila['id_pago'].']" value = "'.$fila['precio'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="total['.$fila['id_pago'].']" value = "'.$fila['total'].'" class="campoActualiza"/></td>

                   
                    <td><input type="submit" name = "actualizar" value = "Actualizar" class = "campo"></td>
              </tr>';
    }
?>