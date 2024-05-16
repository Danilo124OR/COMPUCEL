<?php
include("../principal/conexion_bd.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $id_tecnico = $_POST['Id_tecnico'];
    $Nombre = $_POST['Nombre_tecnico'];
    $telefono = $_POST['Telefono'];
    

    // Verificar si numero de orden ya existe en la base de datos
    $sql_check = "SELECT Id_tecnico FROM técnicos WHERE Id_tecnico = '$id_tecnico'";
    $result = $conexion->query($sql_check);
    if ($result === FALSE) {
        echo "Error al ejecutar la consulta: " . $conexion->error;
    } else {
        if ($result->num_rows > 0) {
            echo "<script>alert('El ID del Técnico ya existe.'); window.location.href = 'TecnicoFormularioInsertar.php';</script>";
        } else {
            // Preparar la consulta SQL para insertar datos
            $sql = "INSERT INTO técnicos (Id_tecnico, Nombre_tecnico, Teléfono) 
            VALUES ('$id_tecnico', '$Nombre', '$telefono')";

            // Ejecutar la consulta
            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('Datos insertados correctamente.'); window.location.href = 'TecnicoFormularioInsertar.php';</script>";
            } else {
                echo "<script>alert('Error al insertar datos: " . $conexion->error . "');window.location.href = 'TecnicoFormularioInsertar.php';</script>";
            }
        }
    }
}

// Consulta para obtener el último ID de cliente insertado
$sql_last_id = "SELECT MAX(Id_tecnico) AS max_id FROM Técnicos";
$result_last_id = $conexion->query($sql_last_id);
$next_id = 1; // Por defecto, si no hay clientes en la base de datos

// Verificar si la consulta se ejecutó correctamente
if ($result_last_id === FALSE) {
    echo "Error al ejecutar la consulta: " . $conexion->error;
} else {
    // Verificar si hay resultados y obtener el siguiente ID de cliente
    if ($result_last_id->num_rows > 0) {
        $row = $result_last_id->fetch_assoc();
        $next_id = $row['max_id'] + 1;
    }
}
?>