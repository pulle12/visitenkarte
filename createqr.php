<?php

use chillerlan\QRCode\QRCode;

require_once("vendor/autoload.php");
require_once("createpdf.php");

$data = $pdf->Output('S');

// quick and simple:
echo '<img width="200px" src="'.(new QRCode)->render($data).'" alt="QR Code" />';