<?php
require_once("vendor/autoload.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(40, 10, $daten );
$pdf->Cell(40, 10, "");