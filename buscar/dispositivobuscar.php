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
            echo "</tr>";
        }
        echo "</ta>";
        // Botón para regresar

    } else {
        echo "<script>alert('No existe el ID o Nombre.'); window.location.href = 'dispositivoformulariob.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
