<?php
// Conexión a la base de datos
include '../principal/conexion_bd.php';
$resultado = $conexion->query("SELECT * FROM técnicos");
// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
foreach ($_POST['id_tecnico'] as $ids){
    $editId=mysqli_real_escape_string($conexion, $_POST['id_tecnico'][$ids]);
    $editNom=mysqli_real_escape_string($conexion, $_POST['nombre_tecnico'][$ids]);
    $editTel=mysqli_real_escape_string($conexion, $_POST['telefono'][$ids]);
    
    $actualizar=$conexion->query("UPDATE técnicos SET Id_tecnico = '$editId', Nombre_tecnico = '$editNom', Teléfono = $editTel WHERE Id_tecnico = '$ids'");
    echo "<script>alert('Datos actualizados.');</script>";
}
$resultado = $conexion->query("SELECT * FROM técnicos");
}

    while ($fila = $resultado->fetch_assoc()) {
        // Formulario de actualización para cada fila
        echo '<tr>
                    <td><input type="text" readonly name="id_tecnico['.$fila['Id_tecnico'].']" value="'.$fila['Id_tecnico'].'"  class="campoActualiza"/></td>
                    <td><input type="text" name="nombre_tecnico['.$fila['Id_tecnico'].']" value = "'.$fila['Nombre_tecnico'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="telefono['.$fila['Id_tecnico'].']" value = "'.$fila['Teléfono'].'" class="campoActualiza"/></td>
                    <td><input type="submit" name = "actualizar" value = "Actualizar" class = "campo"></td>
              </tr>';
    }
?>