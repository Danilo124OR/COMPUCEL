<?php
// Crear la conexión a la base de datos
include("../principal/conexion_bd.php");

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    // Verificar si se recibió correctamente el ID del cliente
    if(isset($_POST['no_orden'])) {
        $noorden = $_POST['no_orden'];
        // Recibir datos del formulario de actualización y validarlos
        $idtecnico = $_POST['Id_tecnico'];
        $nomtecnico = $_POST['Nombre_técnico'];
        $idcliente = $_POST['id_cliente'];
        $nomcliente = $_POST['Nombre_cliente'];
        $mol = $_POST['Modelo'];
        $tipodis = $_POST['Tipo_dispositivo'];
        $mar = $_POST['Marca'];
        $imei = $_POST['IMEI'];
        $ingreso = $_POST['Fecha_ingreso'];
        $entrega = $_POST['Fecha_entrega'];
        $detalle = $_POST['detalles_reparaciones'];
        $estado = $_POST['estado_dispositivo'];

        // Validamos que los campos no estén vacíos
        if(empty($idtecnico) || empty($nomtecnico) || empty($idcliente) || empty($nomcliente) || empty($mol) || empty($tipodis) || empty($mar) || empty($imei) || empty($ingreso) || empty($entrega) || empty($detalle) || empty($estado)) {
            echo "Por favor, complete todos los campos.";
        } else {
            // Escapamos los valores para evitar inyección de SQL
           
            $idtecnico = $conexion->real_escape_string($idtecnico);
            $nomtecnico = $conexion->real_escape_string($nomtecnico);
            $idcliente = $conexion->real_escape_string($idcliente);
            $nomcliente = $conexion->real_escape_string($nomcliente);
            $mol = $conexion->real_escape_string($mol);
            $tipodis = $conexion->real_escape_string($tipodis);
            $mar = $conexion->real_escape_string($mar);
            $imei = $conexion->real_escape_string($imei);
            $ingreso = $conexion->real_escape_string($ingreso);
            $entrega = $conexion->real_escape_string($entrega);
            $detalle = $conexion->real_escape_string($detalle);
            $estado = $conexion->real_escape_string($estado);
           

            // Construir la consulta SQL para actualizar
            $sql = "UPDATE dispositivos1 SET ID_tecnico='$idtecnico', Nombre_técnico='$nomtecnico', id_cliente='$idcliente', Nombre_cliente='$nomcliente', Modelo='$mol', Tipo_dispositivo='$tipodis', Marca='$mar', IMEI='$imei', Fecha_ingreso='$ingreso', Fecha_entrega='$entrega', detalles_reparaciones='$detalle', estado_dispositivo='$estado' WHERE no_orden='$noorden'";

            // Ejecutar la consulta y manejar errores
            if ($conexion->query($sql) === TRUE) {
                //echo "Datos actualizados correctamente.";
                echo "<script>alert('Datos actualiazados correctamente.'); window.location.href = 'DispositivoFormulario.php';</script>";

            } else {
                //echo "Error al actualizar los datos: " . $conexion->error;
                echo "<script>alert('Error al actualizar los datos: " . $conexion->error . "');window.location.href = 'DispositivoFormulario.php';</script>";

                
            }
        }
    } else {
        echo "El campo 'id_cliente' no se recibió correctamente.";
    }
}
?>
