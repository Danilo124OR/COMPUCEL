<?php

require '../principal/conexion_bd.php';
require '../fpdf186/fpdf.php';

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

$idVenta = isset($_GET['no_orden']) ? $conexion->real_escape_string($_GET['no_orden']) : 1;

if (filter_var($idVenta, FILTER_VALIDATE_INT) === false) {
    $idVenta = 2;
}

$sqlVenta = "SELECT no_orden FROM dispositivos1 WHERE no_orden = $idVenta LIMIT 1";
$resultado = $conexion->query($sqlVenta);
$row_venta = $resultado->fetch_assoc();
$orden = $row_venta['no_orden'];

$sqlDetalle = "SELECT Cantidad, Dispositivos, detalles, Fecha_pago, Hora_pago, precio, total FROM pagos WHERE id_pago = $idVenta";
$resultadoDetalle = $conexion->query($sqlDetalle);
$row_ventaD = $resultadoDetalle->fetch_assoc();
$total = number_format($row_ventaD['total'], 2, '.');

$pdf = new FPDF('P', 'mm', array(80, 150));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Image('../image/logo.png', 27, 2, 25); //2 puntos en y/15 puntos de x

$pdf->Ln(18); //salto de linea
$pdf->MultiCell(70, 5, 'TIENDA COMPUCEL', 0, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 4, mb_convert_encoding('Número de Orden:  ' . $orden, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->Cell(70, 2, '---------------------------------------------------------------------------', 0, 1, 'L');
$pdf->Cell(10, 4, 'Cant.', 0, 0, 'L');
$pdf->Cell(18, 4, mb_convert_encoding('Dispositivo', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(11, 4, 'Detalle', 0, 0, 'L');
$pdf->Cell(11, 4, 'Precio', 0, 0, 'L');
$pdf->Cell(9, 4, 'Importe', 0, 1, 'L');
$pdf->Cell(70, 2, '---------------------------------------------------------------------------', 0, 1, 'L');

$totaldispositivos = 0;
$pdf->SetFont('Arial', '', 7);

while ($row_producto = $resultadoDetalle->fetch_assoc()) {
    $importe = number_format($row_producto['Cantidad'] * $row_producto['precio'], 2, '.', ',');
    $totaldispositivos += $row_producto['Cantidad'];

    $pdf->Cell(10, 4, $row_producto['Cantidad'], 0, 0, 'L');

    $yInicio = $pdf->GetY();
    $pdf->SetX(20);
    $pdf->Cell(30, 4, mb_convert_encoding($row_producto['Dispositivos'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
    $yFin = $pdf->GetY();

    $pdf->SetXY(50, $yInicio);
    $pdf->Cell(30, 4, mb_convert_encoding($row_producto['detalles'], 'ISO-8859-1', 'UTF-8'), 0, 'L');

    $pdf->SetXY(45, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . number_format($row_producto['precio'], 2, '.', ','), 0, 0, 'R');

    $pdf->SetXY(60, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . $importe, 0, 1, 'R');
    $pdf->SetY($yFin + 4);
}

$resultadoDetalle->close();

$pdf->Ln();
$pdf->Cell(70, 4, mb_convert_encoding('Número de artículos:  ' . $totaldispositivos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 5, 'Total: '.MONEDA.' '.$total, 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 5, 'Fecha: ' . $row_ventaD['Fecha_pago'], 0, 0, 'C');
$pdf->Cell(35, 5, 'Hora: ' . $row_ventaD['Hora_pago'], 0, 1, 'C');

$pdf->Ln();
$pdf->MultiCell(70, 5, 'AGRADECEMOS SU PREFERENCIA VUELVA PRONTO!!!', 0, 'C');

$resultado->close();
$conexion->close();

$pdf->Output();
?>
