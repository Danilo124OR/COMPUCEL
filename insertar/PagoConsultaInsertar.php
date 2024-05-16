<?php
include("../principal/conexion_bd.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $id_pago = $_POST['id_pago'];
    $no_orden = $_POST['no_orden'];
    $id_cliente = $_POST['Id_cliente'];
    $nombre_cliente = $_POST['Nombre_cliente'];
    $dis = $_POST['Dispositivos'];
    $detalle = $_POST['detalles_reparacion'];
    $cantidad = $_POST['Cantidad_reparada'];
    $fecha = $_POST['Fecha_pago'];
    $hora = $_POST['Hora_pago'];
    $precio = $_POST['precio'];
    $total = $_POST['total'];

    // Verificar si numero de orden ya existe en la base de datos
    $sql_check = "SELECT id_pago FROM pagos WHERE id_pago = '$id_pago'";
    $result = $conexion->query($sql_check);
    if ($result === FALSE) {
        echo "Error al ejecutar la consulta: " . $conexion->error;
    } else {
        if ($result->num_rows > 0) {
            echo "<script>alert('El Numero de orden ya existe.'); window.location.href = 'PagoFormularioInsertar.php';</script>";
        } else {
            // Preparar la consulta SQL para insertar datos
            $sql = "INSERT INTO pagos (id_pago, no_orden, Id_cliente, Nombre_cliente, Dispositivos, Cantidad_reparada, detalles_reparacion, Fecha_pago, Hora_pago, precio, total) 
            VALUES ('$id_pago', '$no_orden', '$id_cliente', '$nombre_cliente', '$dis', '$detalle', '$cantidad', '$fecha', '$hora', '$precio', '$total')";

            // Ejecutar la consulta
            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('Datos insertados correctamente.'); window.location.href = 'PagoFormularioInsertar.php';</script>";
            } else {
                echo "<script>alert('Error al insertar datos: " . $conexion->error . "');window.location.href = 'PagoFormularioInsertar.php';</script>";
            }
        }
    }
}

// Consulta para obtener el último ID de cliente insertado
$sql_last_id = "SELECT MAX(id_pago) AS max_id FROM pagos";
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