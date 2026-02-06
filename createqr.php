<?php

use chillerlan\QRCode\QRCode;

require_once("vendor/autoload.php");

$vcard = '';
if (isset($v)) { // vCard-Format (für Handy-Kontaktdaten) aus den Daten der Visitenkarte erstellen. Template mit den ganzen Felder wie "ORG"
    $fn = trim(($v->getVorname() ?? '') . ' ' . ($v->getNachname() ?? ''));
    $vcard  = "BEGIN:VCARD\nVERSION:3.0\n";
    $vcard .= "N:" . ($v->getNachname() ?? '') . ";" . ($v->getVorname() ?? '') . "\n";
    $vcard .= "FN:" . $fn . "\n";
    if ($v->getFirma())   $vcard .= "ORG:" . $v->getFirma() . "\n";
    if ($v->getPosition()) $vcard .= "TITLE:" . $v->getPosition() . "\n";
    if ($v->getTelefon()) $vcard .= "TEL;TYPE=WORK,VOICE:" . $v->getTelefon() . "\n";
    if ($v->getEmail())   $vcard .= "EMAIL:" . $v->getEmail() . "\n";
    if ($v->getAdresse()) $vcard .= "ADR;TYPE=WORK:;;" . $v->getAdresse() . "\n";
    if ($v->getWebsite()) $vcard .= "URL:" . $v->getWebsite() . "\n";
    $vcard .= "END:VCARD";
} else {
    $vcard = $daten ?? '';
}

// QR aus der vCard (oder dem kurzen Text) generieren — das ergibt einen viel einfacheren QR
echo '<img width="200px" src="'. (new QRCode)->render($vcard) .'" alt="QR Code" />';
