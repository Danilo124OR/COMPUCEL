<?php
// Conexión a la base de datos
include '../principal/conexion_bd.php';
$resultado = $conexion->query("SELECT * FROM usuarios");
// Verificar si se envió el formulario de actualización
if (isset($_POST['actualizar'])) {
foreach ($_POST['usuario'] as $ids){
    $editId=mysqli_real_escape_string($conexion, $_POST['usuario'][$ids]);
    $editNom=mysqli_real_escape_string($conexion, $_POST['nombre'][$ids]);
    $editClave=mysqli_real_escape_string($conexion, $_POST['clave'][$ids]);
    $actualizar=$conexion->query("UPDATE usuarios SET Id_Usuario = '$editId', Nombre = '$editNom', Clave = '$editClave'
                                        WHERE Id_Usuario = '$ids'");
}
echo "<script>alert('Datos actualizados.');</script>";
$resultado = $conexion->query("SELECT * FROM usuarios");
}

    while ($fila = $resultado->fetch_assoc()) {
        // Formulario de actualización para cada fila
        echo '<tr>
                    <td><input type="text" readonly name="usuario['.$fila['Id_Usuario'].']" value="'.$fila['Id_Usuario'].'"  class="campoActualiza"/></td>
                    <td><input type="text" name="nombre['.$fila['Id_Usuario'].']" value = "'.$fila['Nombre'].'" class="campoActualiza"/></td>
                    <td><input type="text" name="clave['.$fila['Id_Usuario'].']" value = "'.$fila['Clave'].'" class="campoActualiza"/></td>
                    <td><input type="submit" name = "actualizar" value = "Actualizar" class = "campo"></td>
              </tr>';
    }
?>