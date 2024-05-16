<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_busqueda = $_POST["tipo_busqueda"];
    $valor_busqueda = $_POST["valor_busqueda"];

    // Consulta SQL según el tipo de búsqueda
    if ($tipo_busqueda == "id_tecnico") {
        $sql = "SELECT Id_tecnico, Nombre_tecnico, Teléfono FROM técnicos WHERE Id_tecnico = ?";
    } else if ($tipo_busqueda == "nombre") {
        $sql = "SELECT Id_tecnico, Nombre_tecnico, Teléfono FROM técnicos WHERE Nombre_tecnico LIKE ?";
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
            echo "<td class='celdas'>" . $row["Id_tecnico"] . "</td>"; // Acceder a la columna "id_cliente"
            echo "<td class='celdas'>" . $row["Nombre_tecnico"] . "</td>";
            echo "<td class='celdas'>" . $row["Teléfono"] . "</td>";
            echo "</tr>";
        }
        echo "</ta>";
        // Botón para regresar

    } else {
        echo "<script>alert('No existe el ID o Nombre del Técnico.'); window.location.href = 'TecnicoBuscarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
