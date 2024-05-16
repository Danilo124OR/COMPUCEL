<?php
include("../principal/conexion_bd.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $no_orden = $_POST['no_orden'];
    $id_tecnico = $_POST['id_tecnico'];
    $nombre_tecnico = $_POST['nombre_tecnico'];
    $id_cliente = $_POST['id_cliente'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $modelo = $_POST['modelo'];
    $tipo_dispositivo = $_POST['tipo_dispositivo'];
    $marca = $_POST['marca'];
    $imei = $_POST['imei'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $detalles_reparaciones = $_POST['detalles_reparaciones'];
    $estado_dispositivo = $_POST['estado_dispositivo'];

    // Verificar si numero de orden ya existe en la base de datos
    $sql_check = "SELECT no_orden FROM dispositivos1 WHERE no_orden = '$no_orden'";
    $result = $conexion->query($sql_check);
    if ($result === FALSE) {
        echo "Error al ejecutar la consulta: " . $conexion->error;
    } else {
        if ($result->num_rows > 0) {
            echo "<script>alert('El Numero de orden ya existe.'); window.location.href = 'dispositivoformularioInsertar.php';</script>";
        } else {
            // Preparar la consulta SQL para insertar datos
            $sql = "INSERT INTO dispositivos1 (no_orden, ID_tecnico, Nombre_técnico, id_cliente, Nombre_cliente, Modelo, Tipo_dispositivo, Marca, IMEI, Fecha_ingreso, Fecha_entrega, detalles_reparaciones, estado_dispositivo) 
            VALUES ('$no_orden', '$id_tecnico', '$nombre_tecnico', '$id_cliente', '$nombre_cliente', '$modelo', '$tipo_dispositivo', '$marca', '$imei', '$fecha_ingreso', '$fecha_entrega', '$detalles_reparaciones', '$estado_dispositivo')";

            // Ejecutar la consulta
            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('Datos insertados correctamente.'); window.location.href = 'dispositivoformularioInsertar.php';</script>";
            } else {
                echo "<script>alert('Error al insertar datos: " . $conexion->error . "');window.location.href = 'dispositivoformularioInsertar.php';</script>";
            }
        }
    }
}

// Consulta para obtener el último ID de cliente insertado
$sql_last_id = "SELECT MAX(no_orden) AS max_id FROM dispositivos1";
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