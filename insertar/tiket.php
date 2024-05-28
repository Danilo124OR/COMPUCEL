<?php
require '../principal/conexion_bd.php';
require '../fpdf186/fpdf.php';

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

// Obtener el id_pago de la solicitud (asumiendo que se pasa como parámetro GET)
$id_pago = isset($_GET['id_pago']) ? intval($_GET['id_pago']) : 0;

// Verificar si el id_pago es válido
if ($id_pago <= 0) {
    die('ID de pago no válido.');
}

// Crear instancia de FPDF
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetMargins(5, 5, 5);
$pdf->Image('../image/logo.png', 27, 2, 25);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Ln(18);
$pdf->MultiCell(70, 5, 'TIENDA COMPUCEL', 0, 'C');
$pdf->Ln(1);
$pdf->MultiCell(70, 5, 'OBREGON 91A', 0, 'C');
$pdf->Ln(1);
$pdf->MultiCell(70, 0, 'COLONIA 20 DE NOVIEMBRE', 0, 'C');
$pdf->Ln(1);
$pdf->MultiCell(70, 5, 'CODIGO POSTAL: 40060', 0, 'C');
$pdf->Ln(1);

// Consulta para obtener el no_orden y Nombre_cliente relacionados con el id_pago
$sql_orden_cliente = "
    SELECT d.no_orden, d.Nombre_cliente
    FROM dispositivos1 d
    JOIN pagos p ON d.no_orden = p.no_orden
    WHERE p.id_pago = '$id_pago'";

$result_orden_cliente = $conexion->query($sql_orden_cliente);

if ($result_orden_cliente === false) {
    die('Error en la consulta: ' . $conexion->error);
}

if ($result_orden_cliente->num_rows > 0) {
    $row_orden_cliente = $result_orden_cliente->fetch_assoc();
    $no_orden = $row_orden_cliente["no_orden"];
    $nombre_cliente = $row_orden_cliente["Nombre_cliente"];
    $sql_cantidad_dispositivos = "SELECT SUM(Cantidad) AS total_dispositivos 
                                   FROM pagos 
                                   WHERE no_orden = '$no_orden'";

    $result_cantidad_dispositivos = $conexion->query($sql_cantidad_dispositivos);

    if ($result_cantidad_dispositivos === false) {
        die('Error en la consulta de cantidad de dispositivos: ' . $conexion->error);
    }

    if ($result_cantidad_dispositivos->num_rows > 0) {
        $row_cantidad_dispositivos = $result_cantidad_dispositivos->fetch_assoc();
        $total_dispositivos = $row_cantidad_dispositivos['total_dispositivos'];
    } else {
        $total_dispositivos = 0;
    }

    $total_dispositivos = isset($total_dispositivos) ? $total_dispositivos : 0;


    //$total_dispositivos = 0;
    $total_importe = 0.0;

    // Consulta para obtener los datos de pagos relacionados con el no_orden
    $sql_pagos = "SELECT Cantidad, precio, Fecha_pago, Hora_pago FROM pagos WHERE id_pago = '$no_orden'";
    $result_pagos = $conexion->query($sql_pagos);

    if ($result_pagos === false) {
        die('Error en la consulta de pagos: ' . $conexion->error);
    }

    // Consulta para obtener los datos de dispositivos relacionados con el no_orden
    $sql_dispositivos = "SELECT detalles_reparaciones FROM dispositivos1 WHERE no_orden = '$no_orden'";
    $result_dispositivos = $conexion->query($sql_dispositivos);

    if ($result_dispositivos === false) {
        die('Error en la consulta de dispositivos: ' . $conexion->error);
    }

    if ($result_pagos->num_rows > 0 && $result_dispositivos->num_rows > 0) {
        $pdf->Ln();
        $pdf->Cell(70, 5, 'Numero de Orden: ' . $no_orden, 0, 1, 'L');
        $pdf->Cell(70, 5, 'Nombre del Cliente: ' . $nombre_cliente, 0, 1, 'L');
        $pdf->Ln(1);
        $pdf->Cell(70, 2, '------------------------------------------------------------------------', 0, 1, 'L');
        $pdf->Cell(12, 4, 'Cant.', 0, 0, 'L');
        $pdf->Cell(20, 4, 'Detalle', 0, 0, 'L');
        $pdf->Cell(18, 4, 'Precio', 0, 0, 'L');
        $pdf->Cell(10, 4, 'Importe', 0, 1, 'L');
        $pdf->Cell(70, 2, '------------------------------------------------------------------------', 0, 1, 'L');

        $pdf->SetFont('Arial', '', 8);

        while ($row_pagos = $result_pagos->fetch_assoc()) {
            if ($row_dispositivos = $result_dispositivos->fetch_assoc()) {
                //$cantidad = $row_pagos["Cantidad"];
                $precio = $row_pagos["precio"];
                $fecha = $row_pagos["Fecha_pago"];
                $hora = $row_pagos["Hora_pago"];
                $importe = $total_dispositivos * $precio;
                //$total_dispositivos += $cantidad;
                $total_importe += $importe;

                $yInicio = $pdf->GetY();
                $pdf->Cell(12, 4, $total_dispositivos, 0, 0, 'L');

                $x = $pdf->GetX();
                $pdf->MultiCell(20, 4, mb_convert_encoding($row_dispositivos['detalles_reparaciones'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
                $yFin = $pdf->GetY();

                $pdf->SetXY($x + 20, $yInicio);
                $pdf->Cell(18, 4, MONEDA . ' ' . number_format($precio, 2, '.', ','), 0, 0, 'L');
                $pdf->Cell(10, 4, MONEDA . ' ' . number_format($importe, 2, '.', ','), 0, 1, 'L');

                $pdf->SetY($yFin);
            } else {
                $pdf->Cell(70, 4, 'No se encontraron detalles del dispositivo.', 0, 1, 'L');
            }
        }

        $pdf->Ln();
        $pdf->Cell(70, 4, mb_convert_encoding('Número de artículos: ' . $total_dispositivos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(60, 5, 'Total: ' . MONEDA . ' ' . number_format($total_importe, 2, '.', ','), 0, 1, 'R');

        $pdf->Ln(2);

        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(35, 5, 'Fecha: ' . $fecha, 0, 0, 'C');
        $pdf->Cell(35, 5, 'Hora: ' . $hora, 0, 1, 'C');

        $pdf->Ln();
        $pdf->MultiCell(70, 5, 'AGRADECEMOS SU PREFERENCIA VUELVA PRONTO!!!', 0, 'C');
    } else {
        $pdf->Cell(70, 4, 'No se encontraron pagos o dispositivos para el numero de orden: ' . $no_orden, 0, 1, 'L');
    }
} else {
    $pdf->Cell(40, 10, 'No se encontraron ordenes.');
}

// Cerrar la conexión
$conexion->close();

// Salida del archivo PDF
$pdf->Output();
?>
