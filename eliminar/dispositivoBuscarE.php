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
    if ($tipo_busqueda == "no_orden") {
        $sql = "SELECT no_orden, ID_tecnico, Nombre_técnico, id_cliente, Nombre_cliente, Modelo, Tipo_dispositivo, Marca, IMEI, Fecha_ingreso, Fecha_entrega, detalles_reparaciones, estado_dispositivo FROM dispositivos1 WHERE no_orden = ?";
    } else if ($tipo_busqueda == "Nombre_cliente") {
        $sql = "SELECT no_orden, ID_tecnico, Nombre_técnico, id_cliente, Nombre_cliente, Modelo, Tipo_dispositivo, Marca, IMEI, Fecha_ingreso, Fecha_entrega, detalles_reparaciones, estado_dispositivo FROM dispositivos1 WHERE Nombre_cliente LIKE ?";
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
        echo "<form action= 'dispositivoEliminar.php' method='POST'>";
        echo "<h1>Lista de Ordenes</h1>";
        echo "<table id='TablaClientes' align='center'>";
        echo "
        <tr>
        <th class='encabezado'>Numero de orden</th>
        <th class='encabezado'>ID de tecnico</th>
        <th class='encabezado'>Nomdre de técnico</th>
        <th class='encabezado'>Id de cliente</th>
        <th class='encabezado'>Nombre de Cliente</th>
        <th class='encabezado'>Modelo</th>
        <th class='encabezado'>Tipo de Dispositivo</th>
        <th class='encabezado'>Marca</th>
        <th class='encabezado'>IMEI</th>
        <th class='encabezado'>Fecha de Ingreso</th>
        <th class='encabezado'>Fecha de Entrega</th>
        <th class='encabezado'>Detalle de Reparación</th>
        <th class='encabezado'>Estado del Dispositivo</th> </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='celdas'>" . $row["no_orden"] . "</td>"; // Acceder a la columna "id_cliente"
            echo "<td class='celdas'>" . $row["ID_tecnico"] . "</td>";
            echo "<td class='celdas'>" . $row["Nombre_técnico"] . "</td>";
            echo "<td class='celdas'>" . $row["id_cliente"] . "</td>";
            echo "<td class='celdas'>" . $row["Nombre_cliente"] . "</td>";
            echo "<td class='celdas'>" . $row["Modelo"] . "</td>";
            echo "<td class='celdas'>" . $row["Tipo_dispositivo"] . "</td>";
            echo "<td class='celdas'>" . $row["Marca"] . "</td>";
            echo "<td class='celdas'>" . $row["IMEI"] . "</td>";
            echo "<td class='celdas'>" . $row["Fecha_ingreso"] . "</td>";
            echo "<td class='celdas'>" . $row["Fecha_entrega"] . "</td>";
            echo "<td class='celdas'>" . $row["detalles_reparaciones"] . "</td>";
            echo "<td class='celdas'>" . $row["estado_dispositivo"] . "</td>";

            echo "<td><input type='submit' name='eliminar' class='campo' value='Eliminar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este cliente?\")'></td>"; // Botón de eliminación con confirmación
            echo "<input type='hidden' name='no_orden' value='" . $row["no_orden"] . "'>"; // Campo oculto para pasar el id_cliente
            
            echo "</tr>";
            
            
        }
        //include 'dispositivoBuscarE.php';
            // Botón para regresar
            echo "</table>";
            echo "</form>";
            echo "<form action='dispositivoformularioE.php'>";
            echo "<input type='submit' value='Regresar' class='campo'>";
        echo "</form>";
            echo "</div>";
    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontraron datos de la busqueda.'); window.location.href = 'dispositivoformularioE.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
include '../principal/menu.html';
?>
</body>
</html>

