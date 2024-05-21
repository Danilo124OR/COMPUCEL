<?php
require('FPDF/fpdf.php');
$factura = $_POST["factura"];
$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image("img/sep2.jpg", 10, 10, 180, 33);
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(10,45);
//$pdf->Cell(0,0,utf8_decode('¡Mi primera página pdf con FPDF!'));


$conn = new mysqli("localhost","root","","tiket");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT venta.Folio,cliente.Nombre,venta.Fecha,venta.Hora,productos.Descr,detalle_venta.Preciov,detalle_venta.Cantida FROM venta, detalle_venta as detalle_venta ,cliente,productos WHERE '$factura' = venta.Folio and venta.Folio=detalle_venta.Folio and detalle_venta.Clave=productos.Clave and cliente.RFC=venta.Rfc;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
	$i=0; $total = 0;

  while($row = $result->fetch_assoc()) {
    $nombre = $row["Nombre"];
	 $fecha = $row["Fecha"];
	  $Descr = $row["Descr"];
	   $Preciov = $row["Preciov"];
	    $Cantida = $row["Cantida"];
	$pdf->SetXY(10,80+$i);
	$pdf->Cell(0,0,utf8_decode($Descr));
	$pdf->SetXY(70,80+$i);
	$pdf->Cell(0,0,utf8_decode($Preciov));
	$pdf->SetXY(80,80+$i);
	$pdf->Cell(0,0,utf8_decode($Cantida));
	$pdf->SetXY(100,80+$i);
	$pdf->Cell(0,0,utf8_decode($Cantida*$Preciov));
	$total = $total + $Cantida*$Preciov;
	$i=$i+10;
	
	
  }
$pdf->SetXY(10,60);
$pdf->Cell(0,0,utf8_decode($nombre));
$pdf->SetXY(10,70);
$pdf->Cell(0,0,utf8_decode($fecha));
$pdf->SetXY(100,110);
$pdf->Cell(0,0,utf8_decode($total));
} 



$pdf->Output();
?>