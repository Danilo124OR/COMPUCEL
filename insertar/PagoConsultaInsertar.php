<?php
include("../principal/conexion_bd.php");
require('../fpdf186/fpdf.php');  // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $id_pago = $_POST['idPago'];
    $no_orden = $_POST['noOrden'];
    $detalle = $_POST['detalle'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $precio = $_POST['precio'];
    
    // Verificar que los valores total, pago y cambio están presentes
    if (!isset($_POST['total']) || !isset($_POST['pago']) || !isset($_POST['cambio'])) {
        die('Faltan datos necesarios en el formulario.');
    }
    $total_general = $_POST['total'];
    $pago_con = $_POST['pago'];
    $cambio = $_POST['cambio'];

    // Verificar si los datos son arrays
    if (is_array($id_pago) && is_array($no_orden) &&
        is_array($detalle) && is_array($cantidad) && is_array($fecha) &&
        is_array($hora) && is_array($precio)) {
        
        $all_inserted = true;
        for ($i = 0; $i < count($id_pago); $i++) {
            $idPago = $id_pago[$i];
            $noOrden = $no_orden[$i];
            $detalleReparacion = $detalle[$i];
            $cantidadReparada = $cantidad[$i];
            $fechaPago = $fecha[$i];
            $horaPago = $hora[$i];
            $precioPago = $precio[$i];

            // Verificar si el número de orden ya existe en la base de datos
            $sql_check = "SELECT id_pago FROM pagos WHERE id_pago = '$idPago'";
            $result = $conexion->query($sql_check);
            if ($result === FALSE) {
                echo "Error al ejecutar la consulta: " . $conexion->error;
                $all_inserted = false;
                break;
            } else {
                if ($result->num_rows > 0) {
                    echo "<script>alert('El Número de orden $idPago ya existe.'); window.location.href = 'PagoFormularioInsertar.php';</script>";
                    $all_inserted = false;
                    break;
                } else {
                    // Preparar la consulta SQL para insertar datos
                    $sql = "INSERT INTO pagos (id_pago, no_orden, Cantidad_reparada, detalles_reparacion, Fecha_pago, Hora_pago, precio) 
                            VALUES ('$idPago', '$noOrden', '$cantidadReparada', '$detalleReparacion', '$fechaPago', '$horaPago', '$precioPago')";

                    // Ejecutar la consulta
                    if ($conexion->query($sql) === FALSE) {
                        echo "<script>alert('Error al insertar datos: " . $conexion->error . "'); window.location.href = 'PagoFormularioInsertar.php';</script>";
                        $all_inserted = false;
                        break;
                    }
                }
            }
        }

        if ($all_inserted) {
            // Crear instancia de FPDF
            $pdf = new FPDF('P', 'mm', array(80, 200));
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetMargins(5, 5, 5);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Image('../image/logo.png', 27, 2, 25); //2 puntos en y/15 puntos de x

            $pdf->Ln(18); //salto de linea
            $pdf->MultiCell(70, 5, 'TIENDA COMPUCEL', 0, 'C');
            $pdf->Ln(1);
            $pdf->MultiCell(70, 5, 'OBREGON 91A', 0, 'C');
            $pdf->Ln(1);
            $pdf->MultiCell(70, 0, 'COLONIA 20 DE NOVIEMBRE', 0, 'C');
            $pdf->Ln(1);
            $pdf->MultiCell(70, 5, 'CODIGO POSTAL: 40060', 0, 'C');
            $pdf->Ln(1);

            // Obtener el primer número de orden para los detalles del cliente
            $primer_no_orden = $no_orden[0];

            // Consulta para obtener los datos del cliente y los pagos
            $sql_cliente = "SELECT Nombre_cliente FROM dispositivos1 WHERE no_orden = '$primer_no_orden'";
            $result_cliente = $conexion->query($sql_cliente);

            if ($result_cliente->num_rows > 0) {
                $row_cliente = $result_cliente->fetch_assoc();
                $nombre_cliente = $row_cliente["Nombre_cliente"];
                
                $total_dispositivos = 0;
                $total_importe = 0.0;

                $pdf->Ln();
                $pdf->Cell(40, 10, 'Numero de Orden: ' . $primer_no_orden, 0, 1, 'L');
                $pdf->Cell(40, 0, 'Nombre del Cliente: ' . $nombre_cliente, 0, 1, 'L');
                $pdf->Ln(6);  // Salto de línea pequeño

                $pdf->Ln();
                $pdf->Cell(70, 2, '------------------------------------------------------------------------', 0, 1, 'L');
                $pdf->Cell(12, 4, 'Cant.', 0, 0, 'L');
                $pdf->Cell(20, 4, 'Detalle', 0, 0, 'L');
                $pdf->Cell(18, 4, 'Precio', 0, 0, 'L');
                $pdf->Cell(10, 4, 'Importe', 0, 1, 'L');
                $pdf->Cell(70, 2, '------------------------------------------------------------------------', 0, 1, 'L');

                $pdf->SetFont('Arial', '', 8);
                for ($i = 0; $i < count($id_pago); $i++) {
                    if ($no_orden[$i] == $primer_no_orden) {
                        $cantidad = $cantidad[$i];
                        $precio = $precio[$i];
                        $fecha = $fecha[$i];
                        $hora = $hora[$i];
                        $importe = $cantidad * $precio;
                        $total_dispositivos += $cantidad;
                        $total_importe += $importe;
                        $yFin = $pdf->GetY();

                        $pdf->Cell(12, 4, $cantidad, 0, 0, 'L');
                        $yInicio = $pdf->GetY();
                        $x = $pdf->GetX();
                        $pdf->MultiCell(20, 4, mb_convert_encoding($detalle[$i], 'ISO-8859-1', 'UTF-8'), 0, 'L');
                        $yFin = $pdf->GetY();
                        $pdf->SetXY($x + 20, $yInicio);
                        $pdf->Cell(18, 4, ' ' . number_format($precio, 2, '.', ','), 0, 0, 'L');
                        $pdf->Cell(10, 4, ' ' . $importe, 0, 1, 'L');
                        $pdf->SetY($yFin);
                    }
                }

                $pdf->Ln();
                $pdf->Cell(70, 4, mb_convert_encoding('Número de artículos:  ' . $total_dispositivos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(60, 5, 'Total: ' . number_format((float)$total_general, 2, '.', ','), 0, 1, 'L');
                $pdf->Cell(60, 5, 'Pago con: ' . number_format((float)$pago_con, 2, '.', ','), 0, 1, 'L');
                $pdf->Cell(60, 5, 'Cambio: ' . number_format((float)$cambio, 2, '.', ','), 0, 1, 'L');
            }

            $pdf->Output();
        }
    }
}
?>
