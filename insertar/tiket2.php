<?php

require '../principal/conexion_bd.php';
require '../fpdf186/fpdf.php';
//require 'helpers/NumeroALetras.php';

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

$idVenta = isset($_GET['no_orden']) ? $conexion->real_escape_string($_GET['no_orden']) : 1;

if (filter_var($idVenta, FILTER_VALIDATE_INT) === false) {
    $idVenta = 1;
}

echo "ID Venta: " . $idVenta . "<br>";

$sqlVenta = "SELECT no_orden FROM dispositivos1 WHERE no_orden = $idVenta LIMIT 1";
echo "Consulta Venta: " . $sqlVenta . "<br>";

$resultado = $conexion->query($sqlVenta);

if (!$resultado) {
    die("Error en la consulta SQL (Venta): " . $conexion->error);
}

$row_venta = $resultado->fetch_assoc();
if (!$row_venta) {
    die("No se encontró ninguna venta con no_orden: " . $idVenta);
}

$sqlDetalle = "SELECT cantidad, Dispositivos, detalles, precio, total FROM pagos WHERE id_pago = $idVenta";
echo "Consulta Detalle: " . $sqlDetalle . "<br>";

$resultadoDetalle = $conexion->query($sqlDetalle);

if (!$resultadoDetalle) {
    die("Error en la consulta SQL (Detalle): " . $conexion->error);
}

$row_ventaD = $resultadoDetalle->fetch_assoc();
if (!$row_ventaD) {
    die("No se encontraron detalles para id_pago: " . $idVenta);
}

$total = number_format($row_ventaD['total'], 2, '.', ',');

$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Image('../image/logo.png', 27, 2, 25);

$pdf->Ln(18);
$pdf->MultiCell(70, 5, 'TIENDA COMPUCEL', 0, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(17, 5, mb_convert_encoding('Número de Orden: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(53, 5, $row_venta['no_orden'], 0, 1, 'L');

$pdf->Cell(70, 2, '---------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Cell(10, 4, 'Cant.', 0, 0, 'L');
$pdf->Cell(20, 4, mb_convert_encoding('Dispositivo', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(15, 4, 'Detalle', 0, 0, 'L');
$pdf->Cell(15, 4, 'Precio', 0, 0, 'L');
$pdf->Cell(15, 4, 'Importe', 0, 1, 'L');

$pdf->Cell(70, 2, '---------------------------------------------------------------------------', 0, 1, 'L');

$totaldispositivos = 0;
$pdf->SetFont('Arial', '', 7);

do {
    $importe = number_format($row_ventaD['cantidad'] * $row_ventaD['precio'], 2, '.', ',');
    $totaldispositivos += $row_ventaD['cantidad'];

    $pdf->Cell(10, 4, $row_ventaD['cantidad'], 0, 0, 'L');
    $pdf->MultiCell(30, 4, mb_convert_encoding($row_ventaD['Dispositivos'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $pdf->MultiCell(30, 4, mb_convert_encoding($row_ventaD['detalles'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $pdf->Cell(15, 4, MONEDA . ' ' . number_format($row_ventaD['precio'], 2, '.', ','), 0, 0, 'L');
    $pdf->Cell(15, 4, MONEDA . ' ' . $importe, 0, 1, 'R');

    $row_ventaD = $resultadoDetalle->fetch_assoc();
} while ($row_ventaD);

$pdf->Output();
?>
