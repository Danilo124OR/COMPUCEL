<?php
// Conexión a la base de datos
include '../principal/conexion_bd.php';
$resultado = $conexion->query("SELECT * FROM dispositivos1");
// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
foreach ($_POST['no_orden'] as $ids){

    $editorden=mysqli_real_escape_string($conexion, $_POST['no_orden'][$ids]);
    $editidtec=mysqli_real_escape_string($conexion, $_POST['ID_tecnico'][$ids]);
    $editnomtec=mysqli_real_escape_string($conexion, $_POST['Nombre_técnico'][$ids]);
    $editidcli=mysqli_real_escape_string($conexion, $_POST['id_cliente'][$ids]);
    $editnomcli=mysqli_real_escape_string($conexion, $_POST['Nombre_cliente'][$ids]);
    $editmodelo=mysqli_real_escape_string($conexion, $_POST['Modelo'][$ids]);
    $edittipo=mysqli_real_escape_string($conexion, $_POST['Tipo_dispositivo'][$ids]);
    $editmarca=mysqli_real_escape_string($conexion, $_POST['Marca'][$ids]);
    $editimei=mysqli_real_escape_string($conexion, $_POST['IMEI'][$ids]);
    $editingreso=mysqli_real_escape_string($conexion, $_POST['Fecha_ingreso'][$ids]);
    $editentrega=mysqli_real_escape_string($conexion, $_POST['Fecha_entrega'][$ids]);
    $editdetalle=mysqli_real_escape_string($conexion, $_POST['detalles_reparaciones'][$ids]);
    $editestado=mysqli_real_escape_string($conexion, $_POST['estado_dispositivo'][$ids]);


    $actualizar=$conexion->query("UPDATE dispositivos1 SET no_orden='$editorden', ID_tecnico='$editidtec', Nombre_técnico='$editnomtec', id_cliente='$editidcli', Nombre_cliente='$editnomcli', Modelo='$editmodelo', Tipo_dispositivo='$edittipo', Marca='$editmarca', IMEI='$editimei', Fecha_ingreso='$editingreso', Fecha_entrega='$editentrega', detalles_reparaciones='$editdetalle', estado_dispositivo='$editestado' WHERE no_orden='$ids'");
    echo "<script>alert('Datos actualizados.'); window.location.href = 'DispositivoFormulario.php';</script>";
}
$resultado = $conexion->query("SELECT * FROM dispositivos1");
}

    while ($fila = $resultado->fetch_assoc()) {
        // Formulario de actualización para cada fila
        echo '<tr>
                    <td><input type="text" readonly name="no_orden['.$fila['no_orden'].']" value="'.$fila['no_orden'].'"  class="campoActualiza"/></td>
                    <td><input type="text" name="ID_tecnico['.$fila['no_orden'].']" value = "'.$fila['ID_tecnico'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Nombre_técnico['.$fila['no_orden'].']" value = "'.$fila['Nombre_técnico'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="id_cliente['.$fila['no_orden'].']" value = "'.$fila['id_cliente'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Nombre_cliente['.$fila['no_orden'].']" value = "'.$fila['Nombre_cliente'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Modelo['.$fila['no_orden'].']" value = "'.$fila['Modelo'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Tipo_dispositivo['.$fila['no_orden'].']" value = "'.$fila['Tipo_dispositivo'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Marca['.$fila['no_orden'].']" value = "'.$fila['Marca'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="IMEI['.$fila['no_orden'].']" value = "'.$fila['IMEI'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Fecha_ingreso['.$fila['no_orden'].']" value = "'.$fila['Fecha_ingreso'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="Fecha_entrega['.$fila['no_orden'].']" value = "'.$fila['Fecha_entrega'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="detalles_reparaciones['.$fila['no_orden'].']" value = "'.$fila['detalles_reparaciones'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="estado_dispositivo['.$fila['no_orden'].']" value = "'.$fila['estado_dispositivo'].'" class="campoActualiza"/></td>

                   
                    <td><input type="submit" name = "actualizar" value = "Actualizar" class = "campo"></td>
              </tr>';
    }
?>