<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../estilos/estiloTablas.css">
    <title>Buscar Técnicos</title>
</head>
<body?>
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
        $sql = "SELECT Id_tecnico, Nombre_tecnico, Teléfono FROM técnicos WHERE Id_tecnico LIKE ?";
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
        echo "<div class='contenedorMuestraClientes'>";
        echo "<form action= 'TecnicoEliminarConsulta2.php' method='POST'>";
        echo "<h1>Lista de Técnicos</h1>";
        echo "<table id='TablaClientes' align='center'>";
        echo "<tr><th class='encabezado'>ID de Técnico</th><th class='encabezado'>Nombre de Técnico</th><th class='encabezado'>Teléfono</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='celda'>" . $row["Id_tecnico"] . "</td>"; // Acceder a la columna "id_cliente"
            echo "<td class ='celda'>" . $row["Nombre_tecnico"] . "</td>";
            echo "<td class ='celda'>" . $row["Teléfono"] . "</td>";
            echo "<td><input type='submit' name='eliminar' value='Eliminar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este cliente?\")'></td>"; // Botón de eliminación con confirmación
            echo "<input type='hidden' name='id_tecnico' value='" . $row["Id_tecnico"] . "'>"; // Campo oculto para pasar el id_cliente
            
            echo "</tr>";

        }
            // Botón para regresar
            echo "</table>";
            echo "</form>";
            echo "<form action='TecnicoEliminarFormulario.php'>";
            echo "<input type='submit' value='Regresar'>";
        echo "</form>";
            echo "</div>";
    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontraron datos de la busqueda.'); window.location.href = 'TecnicoEliminarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
include '../principal/menu.html';
?>
</body>
</html>

