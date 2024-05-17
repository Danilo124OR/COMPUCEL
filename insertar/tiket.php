<?php

/**
 * Este script PHP genera un ticket en PDF con información de una venta.
 * Requiere la inclusión de FPDF, conexión a la base de datos y una clase para convertir números a letras.
 *
 * 
 * @author Danilo Ocampo
 */

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

$sqlVenta = "SELECT no_orden from dispositivos1 where no_orden = $idVenta limit 1";

$resultado = $conexion->query($sqlVenta);
$row_venta = $resultado->fetch_assoc();
$total = $row_venta['no_orden'];



$sqlDetalle = "SELECT cantidad, Dispositivos, detalles, precio, total FROM pagos WHERE id_pago = $idVenta";

$resultadoDetalle = $conexion->query($sqlDetalle);

$row_ventaD = $resultadoDetalle->fetch_assoc();
$total = number_format($row_ventaD['total'], 2, '.');



$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);
//el ultimo parametro es el tamaño de la imagen
$pdf->Image('../image/logo.png', 27, 2, 25); //2 puntos en y/15 puntos de x

$pdf->Ln(18); //salto de linea
//primer parametro es el ancho
//el segundo es de alto
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

while ($row_detalle = $resultadoDetalle->fetch_assoc()) {
    $importe = number_format($row_detalle['cantidad'] * $row_detalle['precio'], 2, '.', ',');
    $totaldispositivos += $row_detalle['cantidad'];

    $pdf->Cell(10, 4, $row_detalle['cantidad'], 0, 0, 'L');

    //$yInicio = $pdf->GetY();
    $pdf->MultiCell(30, 4, mb_convert_encoding($row_detalle['Dispositivos'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
    //$yFin = $pdf->GetY();

    $pdf->MultiCell(30, 4, mb_convert_encoding($row_detalle['detalles'], 'ISO-8859-1', 'UTF-8'), 0, 'L');


//    $pdf->SetXY(45, $yInicio);

    $pdf->Cell(15, 4, MONEDA . ' ' . number_format($row_detalle['precio'], 2, '.', ','), 0, 0, 'L');

//    $pdf->SetXY(60, $yInicio);
    $pdf->Cell(15, 4, MONEDA . ' ' . $importe, 0, 1, 'R');
//    $pdf->SetY($yFin);
}
/*
$resultadoDetalle->close();

$pdf->Ln();

$pdf->Cell(70, 4, mb_convert_encoding('Número de articulos:  ' . $totalProductos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 5, sprintf('Total: %s  %s', MONEDA, number_format($total, 2, '.', ',')), 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(70, 4, 'Son ' . strtolower(NumeroALetras::convertir($total, MONEDA_LETRA, MONEDA_DECIMAL)), 0, 'L', 0);

$pdf->Ln();

$pdf->Cell(35, 5, 'Fecha: ' . $row_venta['fecha_venta'], 0, 0, 'C');
$pdf->Cell(35, 5, 'Hora: ' . $row_venta['hora'], 0, 1, 'C');

$pdf->Ln();

$pdf->MultiCell(70, 5, 'AGRADECEMOS SU PREFERENCIA VUELVA PRONTO!!!', 0, 'C');

$resultado->close();
$mysqli->close();
*/
$pdf->Output();