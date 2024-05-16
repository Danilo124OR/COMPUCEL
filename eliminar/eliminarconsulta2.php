<?php
include("../principal/conexion_bd.php");

// Verificar si se ha enviado el formulario para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $id_cliente_eliminar = $_POST["id_cliente"];

    // Consulta SQL para eliminar al cliente
    $sql_eliminar = "DELETE FROM clientes WHERE id_cliente = ?";

    // Preparar la consulta
    $stmt_eliminar = $conexion->prepare($sql_eliminar);

    if ($stmt_eliminar === false) {
        die("Error al preparar la consulta para eliminar el cliente: " . $conexion->error);
    }

    // Bind parameters
    $stmt_eliminar->bind_param("i", $id_cliente_eliminar);

    // Ejecutar la consulta
    if ($stmt_eliminar->execute() === true) {
        echo "<script>alert('Cliente eliminado correctamente.'); window.location.href = 'eliminarformulario.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el cliente.'); window.location.href = 'eliminarformulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt_eliminar->close();
    $conexion->close();
} else {
    // Si se intenta acceder a este script directamente sin enviar el formulario de eliminación
    echo "<script>alert('Acceso no permitido.'); window.location.href = 'eliminarformulario.php';</script>";
}
?>
