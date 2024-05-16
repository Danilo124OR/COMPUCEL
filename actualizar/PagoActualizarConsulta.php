<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['buscar'])) {
    $tipo_busqueda = $_POST["tipo_busqueda"];
    $valor_busqueda = $_POST["valor_busqueda"];

    // Consulta SQL según el tipo de búsqueda
    if ($tipo_busqueda == "id_pago") {
        $sql = "SELECT id_pago, no_orden, Id_cliente, Nombre_cliente, Dispositivos, Cantidad_reparada, detalles_reparacion, Fecha_pago, Hora_pago, precio, total FROM pagos WHERE id_pago = ?";
    } else if ($tipo_busqueda == "Nombre_cliente") {
        $sql = "SELECT id_pago, no_orden, Id_cliente, Nombre_cliente, Dispositivos, Cantidad_reparada, detalles_reparacion, Fecha_pago, Hora_pago, precio, total FROM pagos WHERE Nombre_cliente LIKE ?";
        $valor_busqueda = "%" . $valor_busqueda . "%"; // Añadir comodines para búsqueda parcial
    }

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $valor_busqueda);
    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();
    //Variables para almacenar
    // Mostrar resultados y formulario para actualizar
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $idpago = $row['id_pago'];   
        $orden = $row['no_orden'];
        $idcliente = $row['Id_cliente'];
        $nomcliente = $row['Nombre_cliente'];
        $dis = $row['Dispositivos'];
        $cantidad = $row['Cantidad_reparada'];
        $detalle = $row['detalles_reparacion'];
        $fecha = $row['Fecha_pago'];
        $hora = $row['Hora_pago'];
        $precio = $row['precio'];
        $total = $row['total'];
        }

    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontaron resultados.'); window.location.href = 'PagoActualizarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
