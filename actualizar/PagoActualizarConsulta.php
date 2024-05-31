<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['buscar'])) {
    $tipo_busqueda = $_POST["tipo_busqueda"];
    $valor_busqueda = $_POST["valor_busqueda"];

    // Consulta SQL según el tipo de búsqueda
    if ($tipo_busqueda == "id_pago") {
        $sql = "SELECT id_pago, no_orden, Cantidad_reparada, detalles_reparacion, Fecha_pago, Hora_pago, precio FROM pagos WHERE id_pago = ?";
    } else if ($tipo_busqueda == "no_orden") {
        $sql = "SELECT id_pago, no_orden, Cantidad_reparada, detalles_reparacion, Fecha_pago, Hora_pago, precio FROM pagos WHERE no_orden = ?";
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
        $cantidad = $row['Cantidad_reparada'];
        $detalle = $row['detalles_reparacion'];
        $fecha = $row['Fecha_pago'];
        $hora = $row['Hora_pago'];
        $precio = $row['precio'];
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
