<?php
include("../principal/conexion_bd.php");

// Verificar si se ha enviado el formulario para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $no_orden_eliminar = $_POST["no_orden"];

    // Consulta SQL para eliminar al cliente
    $sql_eliminar = "DELETE FROM dispositivos1 WHERE no_orden = ?";

    // Preparar la consulta
    $stmt_eliminar = $conexion->prepare($sql_eliminar);

    if ($stmt_eliminar === false) {
        die("Error al preparar la consulta para eliminar el cliente: " . $conexion->error);
    }

    // Bind parameters
    $stmt_eliminar->bind_param("i", $no_orden_eliminar);

    // Ejecutar la consulta
    if ($stmt_eliminar->execute() === true) {
        echo "<script>alert('Orden eliminado correctamente.'); window.location.href = 'dispositivoformularioE.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la orden.'); window.location.href = 'dispositivoformularioE.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt_eliminar->close();
    $conexion->close();
} else {
    // Si se intenta acceder a este script directamente sin enviar el formulario de eliminación
    echo "<script>alert('Acceso no permitido.'); window.location.href = 'dispositivoformularioE.php';</script>";
}
?>
