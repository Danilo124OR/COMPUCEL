<?php
//require('fpdf.php');
require '../principal/conexion_bd.php';
require '../fpdf186/fpdf.php';

define('MONEDA', '$');
define('MONEDA_LETRA', 'pesos');
define('MONEDA_DECIMAL', 'centavos');

// Crear instancia de FPDF
//$pdf = new FPDF();
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



// Consulta para obtener todos los no_orden únicos de la tabla pagos
$sql_no_ordenes = "SELECT DISTINCT no_orden, Nombre_cliente FROM dispositivos1";
$result_no_ordenes = $conexion->query($sql_no_ordenes);

if ($result_no_ordenes->num_rows > 0) {
    while ($row_no_ordenes = $result_no_ordenes->fetch_assoc()) {
        $no_orden = $row_no_ordenes["no_orden"];
        $nombre_cliente = $row_no_ordenes["Nombre_cliente"];

        $total_dispositivos = 0;
        $total_importe = 0.0;


        // Consulta para obtener los datos de pagos relacionados con el no_orden
        $sql_pagos = "SELECT Cantidad, Dispositivos, detalles, precio, Fecha_pago, Hora_pago  FROM pagos WHERE no_orden = '$no_orden'";
        $result_pagos = $conexion->query($sql_pagos);

        if ($result_pagos->num_rows > 0) {
            //$pdf->Cell(40, 10, 'Ticket');
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Numero de Orden: ' . $no_orden, 0, 1, 'L');
           // $row_first = $result_no_ordenes->fetch_assoc();
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
            while ($row_pagos = $result_pagos->fetch_assoc()) {
                $cantidad = $row_pagos["Cantidad"];
                $precio = $row_pagos["precio"];
                $fecha =$row_pagos["Fecha_pago"];
                $hora =$row_pagos["Hora_pago"];
                $importe = $cantidad * $precio;
                $total_dispositivos += $cantidad;
                $total_importe += $importe;
                //$yInicio = $pdf->GetY();
                $yFin = $pdf->GetY();

                $pdf->Cell(12, 4, $row_pagos['Cantidad'], 0, 0, 'L');

                $yInicio = $pdf->GetY();
                //$pdf->SetX(20);
                //$yInicio=$pdf->GetY();
                //$pdf->Cell(21, 4, mb_convert_encoding($row_pagos["Dispositivos"], 'ISO-8859-1', 'UTF-8'), 0, 'L');
                //$yFin = $pdf->GetY();

                $x = $pdf->GetX();
                $pdf->MultiCell(20, 4, mb_convert_encoding($row_pagos['detalles'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
                $yFin = $pdf->GetY();


                $pdf->SetXY($x + 20, $yInicio); // Mueve el cursor a la posición correcta
                $pdf->Cell(18, 4, MONEDA . ' ' . number_format($row_pagos['precio'], 2, '.', ','), 0, 0, 'L');
                //$pdf->SetXY(62, $yInicio);
                $pdf->Cell(10, 4, MONEDA . ' ' . $importe, 0, 1, 'L');
                
                $pdf->SetY($yFin);
            }
          
$pdf->Ln();
$pdf->Cell(70, 4, mb_convert_encoding('Número de artículos:  ' . $total_dispositivos, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 5, 'Total: '.MONEDA.' '.$total_importe, 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 5, 'Fecha: ' . $fecha, 0, 0, 'C');
$pdf->Cell(35, 5, 'Hora: ' . $hora, 0, 1, 'C');

$pdf->Ln();
$pdf->MultiCell(70, 5, 'AGRADECEMOS SU PREFERENCIA VUELVA PRONTO!!!', 0, 'C');

        } else {
            $pdf->Cell(40, 10, 'No se encontraron pagos para el numero de orden: ' . $no_orden);
            $pdf->Ln();
        }
    }
} else {
    $pdf->Cell(40, 10, 'No se encontraron ordenes.');
}

// Cerrar la conexión
$conexion->close();

// Salida del archivo PDF
$pdf->Output();
?>
