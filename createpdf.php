<?php
require_once("vendor/autoload.php");
require_once("index.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(40, 10, Visitenkarte.getVorname() . " " . Visitenkarte::getNachname());
$pdf->Cell(40, 10, "");
$pdf->Output();