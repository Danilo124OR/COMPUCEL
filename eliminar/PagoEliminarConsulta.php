<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
    <title>Buscar Cliente</title>
</head>
<body?>
<?php
include("../principal/conexion_bd.php");

// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Mostrar resultados en una tabla
    if ($result->num_rows > 0) {
        echo "<div class='contenedorEliminar'>";
        echo "<form action= 'PagoEliminarConsulta2.php' method='POST'>";
        echo "<h1>Lista de Pagos</h1>";
        echo "<table id='TablaClientes' align='center'>";
        echo "
        <tr>
        <th class='encabezado'>ID de Pago/th>
        <th class='encabezado'>Numero de orden</th>
        <th class='encabezado'>Cantidad Reparada</th>
        <th class='encabezado'>Detalles de Reparación</th>
        <th class='encabezado'>Fecha de Pago</th>
        <th class='encabezado'>Hora de Pago</th>
        <th class='encabezado'>Precio</th>
        <th class='encabezado'>Total</th>
        </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='celdas'>" . $row["id_pago"] . "</td>"; // Acceder a la columna "id_pago"
            echo "<td class='celdas'>" . $row["no_orden"] . "</td>"; 
            echo "<td class='celdas'>" . $row["Cantidad_reparada"] . "</td>";
            echo "<td class='celdas'>" . $row["detalles_reparacion"] . "</td>";
            echo "<td class='celdas'>" . $row["Fecha_pago"] . "</td>";
            echo "<td class='celdas'>" . $row["Hora_pago"] . "</td>";
            echo "<td class='celdas'>" . $row["precio"] . "</td>";

            echo "<td><input type='submit' name='eliminar' class='campo' value='Eliminar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este cliente?\")'></td>"; // Botón de eliminación con confirmación
            echo "<input type='hidden' name='idPago' value='" . $row["id_pago"] . "'>"; // Campo oculto para pasar el id_cliente
            
            echo "</tr>";
            
            
        }
        //include 'dispositivoBuscarE.php';
            // Botón para regresar
            echo "</table>";
            echo "</form>";
            echo "<form action='PagoEliminarFormulario.php'>";
            echo "<input type='submit' value='Regresar' class='campo'>";
        echo "</form>";
            echo "</div>";
    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontraron datos de la busqueda.'); window.location.href = 'PagoEliminarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
include '../principal/menu.html';
?>

</body>
</html>

