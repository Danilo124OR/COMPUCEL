<?php
// Conexión a la base de datos
include '../principal/conexion_bd.php';
$resultado = $conexion->query("SELECT * FROM clientes");
// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
foreach ($_POST['cliente'] as $ids){
    $editId=mysqli_real_escape_string($conexion, $_POST['cliente'][$ids]);
    $editNom=mysqli_real_escape_string($conexion, $_POST['nombre'][$ids]);
    $editTel=mysqli_real_escape_string($conexion, $_POST['telefono'][$ids]);
    
    $actualizar=$conexion->query("UPDATE clientes SET Id_cliente = '$editId', Nombre = '$editNom', Teléfono = $editTel WHERE Id_cliente = '$ids'");
    echo "<script>alert('Datos actualizados.'); window.location.href = 'actualizarformulario.php';</script>";
}
$resultado = $conexion->query("SELECT * FROM clientes");
}

    while ($fila = $resultado->fetch_assoc()) {
        // Formulario de actualización para cada fila
        echo '<tr>
                    <td><input type="text" readonly name="cliente['.$fila['Id_cliente'].']" value="'.$fila['Id_cliente'].'"  class="campoActualiza"/></td>
                    <td><input type="text" name="nombre['.$fila['Id_cliente'].']" value = "'.$fila['Nombre'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="telefono['.$fila['Id_cliente'].']" value = "'.$fila['Teléfono'].'" class="campoActualiza"/></td>
                    <td><input type="submit" name = "actualizar" value = "Actualizar" class = "campo"></td>
              </tr>';
    }
?>