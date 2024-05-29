<?php
include("../principal/conexion_bd.php");

// Consulta para obtener el último ID de cliente insertado
$sql_last_id = "SELECT MAX(Id_Usuario) AS max_id FROM usuarios";
$result_last_id = $conexion->query($sql_last_id);
$next_id = 1; // Por defecto, si no hay clientes en la base de datos

if ($result_last_id && $result_last_id->num_rows > 0) {
    $row = $result_last_id->fetch_assoc();
    $next_id = $row['max_id'] + 1;
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['clave'])) {
        // Recibir los datos del formulario
        $id = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];

// Verificar si el ID ya existe en la base de datos
$sql_check = "SELECT Id_Usuario FROM usuarios WHERE Id_Usuario = '$id'";
$result = $conexion->query($sql_check);
if ($result->num_rows > 0) {
    echo "<script>alert('El ID del usuario ya existe.'); window.location.href = 'usuarioFormulario.php';</script>";
} else {
    // Preparar la consulta SQL para insertar datos
    $sql = "INSERT INTO usuarios (Id_Usuario, Nombre, Clave) VALUES ('$id', '$nombre', '$clave')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Datos insertados correctamente.'); window.location.href = 'usuarioFormulario.php';</script>";
    } else {
        echo "<script>alert('Error al insertar datos: " . $conexion->error . "');window.location.href = 'usuarioFormulario.php';</script>";
    }
}       
    } else {
        echo "<script>alert('Por favor, llena todos los campos'); window.location.href = 'usuarioFormulario.php';</script>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $id = $_POST['id_usuario'];
    $sql_check = "SELECT Id_Usuario FROM usuarios WHERE Id_Usuario = '$id'";
    $result = $conexion->query($sql_check);
    if ($result->num_rows > 0) {
        echo "<script>alert('El ID del clientes ya existe.'); window.location.href = 'usuarioFormulario.php';</script>";
    } else {
        echo "<script>alert('ID disponible'); window.location.href = 'usuarioFormulario.php';</script>";
    }
}
// Cerrar conexión
$conexion->close();
