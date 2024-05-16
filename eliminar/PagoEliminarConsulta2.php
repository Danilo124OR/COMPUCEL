<?php
include("../principal/conexion_bd.php");

// Verificar si se ha enviado el formulario para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $no_pago_eliminar = $_POST["id_pago"];

    // Consulta SQL para eliminar al cliente
    $sql_eliminar = "DELETE FROM pagos WHERE id_pago = ?";

    // Preparar la consulta
    $stmt_eliminar = $conexion->prepare($sql_eliminar);

    if ($stmt_eliminar === false) {
        die("Error al preparar la consulta para eliminar el cliente: " . $conexion->error);
    }

    // Bind parameters
    $stmt_eliminar->bind_param("i", $no_pago_eliminar);

    // Ejecutar la consulta
    if ($stmt_eliminar->execute() === true) {
        echo "<script>alert('Orden eliminado correctamente.'); window.location.href = 'PagoEliminarFormulario.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la orden.'); window.location.href = 'PagoElimnarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt_eliminar->close();
    $conexion->close();
} else {
    // Si se intenta acceder a este script directamente sin enviar el formulario de eliminación
    echo "<script>alert('Acceso no permitido.'); window.location.href = 'PagoElimnarFormulario.php';</script>";
}
?>
