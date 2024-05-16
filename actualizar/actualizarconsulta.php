<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['buscar'])) {
    $tipo_busqueda = $_POST["tipo_busqueda"];
    $valor_busqueda = $_POST["valor_busqueda"];

    // Consulta SQL según el tipo de búsqueda
    if ($tipo_busqueda == "id_cliente") {
        $sql = "SELECT id_cliente, Nombre, Teléfono FROM clientes WHERE id_cliente = ?";
    } else if ($tipo_busqueda == "nombre") {
        $sql = "SELECT id_cliente, Nombre, Teléfono FROM clientes WHERE Nombre LIKE ?";
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
        $Id = $row['id_cliente'];
        $Nombre = $row['Nombre'];
        $Tel = $row['Teléfono'];
        }

    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontaron resultados.'); window.location.href = 'actualizarformulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
