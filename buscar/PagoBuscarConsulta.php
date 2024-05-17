<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_busqueda = $_POST["tipo_busqueda"];
    $valor_busqueda = $_POST["valor_busqueda"];

    // Consulta SQL según el tipo de búsqueda
    if ($tipo_busqueda == "id_pago") {
        $sql = "SELECT id_pago, no_orden, Nombre_cliente, Dispositivos, Cantidad, detalles, Fecha_pago, Hora_pago, precio, total FROM pagos WHERE id_pago = ?";
    } else if ($tipo_busqueda == "Nombre_cliente") {
        $sql = "SELECT id_pago, no_orden, Nombre_cliente, Dispositivos, Cantidad, detalles, Fecha_pago, Hora_pago, precio, total FROM pagos WHERE Nombre_cliente LIKE ?";
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

    // Mostrar resultados en una tabla
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='celdas'>" . $row["id_pago"] . "</td>";
            echo "<td class='celdas'>" . $row["no_orden"] . "</td>"; 
            echo "<td class='celdas'>" . $row["Nombre_cliente"] . "</td>";
            echo "<td class='celdas'>" . $row["Dispositivos"] . "</td>";
            echo "<td class='celdas'>" . $row["Cantidad"] . "</td>";
            echo "<td class='celdas'>" . $row["detalles"] . "</td>";
            echo "<td class='celdas'>" . $row["Fecha_pago"] . "</td>";
            echo "<td class='celdas'>" . $row["Hora_pago"] . "</td>";
            echo "<td class='celdas'>" . $row["precio"] . "</td>";
            echo "<td class='celdas'>" . $row["total"] . "</td>";
            echo "</tr>";
        }
        echo "</ta>";
        // Botón para regresar

    } else {
        echo "<script>alert('No existe el ID o Nombre.'); window.location.href = 'PagoBuscarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
