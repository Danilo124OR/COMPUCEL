<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['buscar'])) {
    $tipo_busqueda = $_POST["tipo_busqueda"];
    $valor_busqueda = $_POST["valor_busqueda"];

    // Consulta SQL según el tipo de búsqueda
    if ($tipo_busqueda == "id_usuario") {
        $sql = "SELECT Id_Usuario, Nombre, Clave FROM usuarios WHERE  Id_Usuario = ?";
    } else if ($tipo_busqueda == "nombre") {
        $sql = "SELECT  Id_Usuario, Nombre, Clave FROM usuarios WHERE Nombre LIKE ?";
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
        $Id = $row['Id_Usuario'];
        $Nombre = $row['Nombre'];
        $clave = $row['Clave'];
        }

    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontaron resultados.'); window.location.href = 'usuarioActualizarFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>