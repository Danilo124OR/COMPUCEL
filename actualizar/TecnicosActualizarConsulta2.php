<?php
// Crear la conexión a la base de datos
include("../principal/conexion_bd.php");

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    // Verificar si se recibió correctamente el ID del cliente
    if(isset($_POST['Id_tecnico'])) {
        $id = $_POST['Id_tecnico'];

        // Recibir datos del formulario de actualización y validarlos
        $nombre = $_POST['Nombre_tecnico'];
        $telefono = $_POST['Teléfono'];

        // Validamos que los campos no estén vacíos
        if(empty($nombre) || empty($telefono)) {
            echo "Por favor, complete todos los campos.";
        } else {
            // Escapamos los valores para evitar inyección de SQL
            $nombre = $conexion->real_escape_string($nombre);
            $telefono = $conexion->real_escape_string($telefono);

            // Construir la consulta SQL para actualizar
            $sql = "UPDATE técnicos SET Nombre_tecnico='$nombre', Teléfono='$telefono' WHERE Id_tecnico='$id'";

            // Ejecutar la consulta y manejar errores
            if ($conexion->query($sql) === TRUE) {
                //echo "Datos actualizados correctamente.";
                echo "<script>alert('Datos actualiazados correctamente.'); window.location.href = 'TecnicosActualizarFormulario.php';</script>";

            } else {
                //echo "Error al actualizar los datos: " . $conexion->error;
                echo "<script>alert('Error al actualizar los datos: " . $conexion->error . "');window.location.href = 'TecnicosActualizarFormulario.php';</script>";

                
            }
        }
    } else {
        echo "El campo 'id_tecnico' no se recibió correctamente.";
    }
}
?>
