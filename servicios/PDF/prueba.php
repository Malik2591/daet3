<?php
require('lib/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Ahuevo se pudo pdf con FPDF!');
$pdf->Output();
?> 