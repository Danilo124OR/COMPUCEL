<?php
    include("../principal/conexion_bd.php"); 

    // Consulta para obtener el último ID de cliente insertado
    $sql_last_id = "SELECT MAX(Id_cliente) AS max_id FROM clientes";
    $result_last_id = $conexion->query($sql_last_id);
    $next_id = 1; // Por defecto, si no hay clientes en la base de datos

    if ($result_last_id && $result_last_id->num_rows > 0) {
        $row = $result_last_id->fetch_assoc();
        $next_id = $row['max_id'] + 1;
    }

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir los datos del formulario
        $id= $_POST['id_cliente'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
    
        // Verificar si el ID ya existe en la base de datos
        $sql_check = "SELECT Id_cliente FROM clientes WHERE Id_cliente = '$id'";
        $result = $conexion->query($sql_check);
        if ($result->num_rows > 0) {
            echo "<script>alert('El ID del clientes ya existe.'); window.location.href = 'insertarformulario.php';</script>";
        } else {
            // Preparar la consulta SQL para insertar datos
            $sql = "INSERT INTO clientes (Id_cliente, Nombre, Teléfono) VALUES ('$id', '$nombre', '$telefono')";
            
            // Ejecutar la consulta
            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('Datos insertados correctamente.'); window.location.href = 'insertarformulario.php';</script>";
            } else {
                echo "<script>alert('Error al insertar datos: " . $conexion->error . "');window.location.href = 'insertarformulario.php';</script>";
            }
        }
    }

    // Cerrar conexión
    $conexion->close();
?>
