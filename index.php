<?php
require_once("vendor/autoload.php");
require_once("Visitenkarte.php");
$v = new Visitenkarte("Max", "Mustermann", "+43 123 456789", "max@mustermann.at", "Musterfirma GmbH", "Geschäftsführer", "Musterstraße 1, 6020 Innsbruck", "www.musterfirma.at");
?>
<!-- HTMl ausgabe der visitankarte -->
<!-- QR und PDF einbinden! -->