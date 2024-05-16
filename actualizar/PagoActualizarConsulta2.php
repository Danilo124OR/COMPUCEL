<?php
// Crear la conexión a la base de datos
include("../principal/conexion_bd.php");

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    // Verificar si se recibió correctamente el ID del cliente
    if(isset($_POST['id_pago'])) {
        $idpago = $_POST['id_pago'];

        // Recibir datos del formulario de actualización y validarlos
        $noorden = $_POST['no_orden'];
        $idcliente = $_POST['Id_cliente'];
        $nomcliente = $_POST['Nombre_cliente'];
        $dis = $_POST['Dispositivos'];
        $cantidad = $_POST['Cantidad_reparada'];
        $detalle = $_POST['detalles_reparacion'];
        $fecha = $_POST['Fecha_pago'];
        $hora = $_POST['Hora_pago'];
        $precio = $_POST['precio'];
        $total = $_POST['total'];

        // Validamos que los campos no estén vacíos
        if(empty($noorden) || empty($idcliente) || empty($nomcliente) || empty($dis) || empty($cantidad) || empty($detalle) || empty($fecha) || empty($hora) || empty($precio) || empty($total) ) {
            echo "Por favor, complete todos los campos.";
        } else {
            // Escapamos los valores para evitar inyección de SQL
           
            $noorden = $conexion->real_escape_string($noorden);
            $idcliente = $conexion->real_escape_string($idcliente);
            $nomcliente = $conexion->real_escape_string($nomcliente);
            $dis = $conexion->real_escape_string($dis);
            $cantidad = $conexion->real_escape_string($cantidad);
            $detalle = $conexion->real_escape_string($detalle);
            $fecha = $conexion->real_escape_string($fecha);
            $hora = $conexion->real_escape_string($hora);
            $precio = $conexion->real_escape_string($precio);
            $total = $conexion->real_escape_string($total);
           

            // Construir la consulta SQL para actualizar
            $sql = "UPDATE pagos SET no_orden='$noorden', Id_cliente='$idcliente', Nombre_cliente='$nomcliente', Dispositivos='$dis', Cantidad_reparada='$cantidad', detalles_reparacion='$detalle', Fecha_pago='$fecha', Hora_pago='$hora', precio='$precio', total='$total' WHERE id_pago='$idpago'";

            // Ejecutar la consulta y manejar errores
            if ($conexion->query($sql) === TRUE) {
                //echo "Datos actualizados correctamente.";
                echo "<script>alert('Datos actualiazados correctamente.'); window.location.href = 'PagoActualizarFormulario.php';</script>";

            } else {
                //echo "Error al actualizar los datos: " . $conexion->error;
                echo "<script>alert('Error al actualizar los datos: " . $conexion->error . "');window.location.href = 'PagoActualizarFormulario.php';</script>";

                
            }
        }
    } else {
        echo "El campo 'id_cliente' no se recibió correctamente.";
    }
}
?>
