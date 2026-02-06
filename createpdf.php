<?php

require_once('vendor/autoload.php');

if (!isset($daten)) {
    $daten = $v ?? '';
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->MultiCell(0, 8, $daten);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 6, "Erstellt am: " . date('Y-m-d H:i'));

// PDF als string im Speicher
$pdfContent = $pdf->Output('S');

// Base64 für Data-URI
$b64 = base64_encode($pdfContent);
$dataUri = 'data:application/pdf;base64,' . $b64;

// Ausgabe: Download-Link und kleines eingebettetes Vorschaubild
echo '<div style="text-align:center;">';
echo '<a href="' . htmlspecialchars($dataUri, ENT_QUOTES, 'UTF-8') . '" download="visitenkarte.pdf">PDF herunterladen</a>';
echo '<br>';
echo '<embed src="' . htmlspecialchars($dataUri, ENT_QUOTES, 'UTF-8') . '" type="application/pdf" width="120" height="160" style="border:1px solid #ccc;margin-top:6px;" />';
echo '</div>';