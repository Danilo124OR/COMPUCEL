<?php
include("../principal/conexion_bd.php");
// Procesar la búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['buscar'])) {
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
    //Variables para almacenar
    // Mostrar resultados y formulario para actualizar
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $orden = $row['no_orden'];
        $idtecnico = $row['ID_tecnico'];
        $nomtecnico = $row['Nombre_técnico'];
        $idcliente = $row['id_cliente'];
        $nomcliente = $row['Nombre_cliente'];
        $mol = $row['Modelo'];
        $tipodis = $row['Tipo_dispositivo'];
        $mar = $row['Marca'];
        $imei = $row['IMEI'];
        $ingreso = $row['Fecha_ingreso'];
        $entrega = $row['Fecha_entrega'];
        $detalle = $row['detalles_reparaciones'];
        $estado = $row['estado_dispositivo'];
        }

    } else {
        //echo "No se encontraron resultados.";
        echo "<script>alert('No se encontaron resultados.'); window.location.href = 'DispositivoFormulario.php';</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
