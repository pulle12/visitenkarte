<?php
require_once("vendor/autoload.php");
require_once("Visitenkarte.php");
$v = new Visitenkarte("Max", "Mustermann", "+43 123 456789", "max@mustermann.at", "Musterfirma GmbH", "Geschäftsführer", "Musterstraße 1, 6020 Innsbruck", "www.musterfirma.at");
function getField($obj, $prop) { // KI-generierte Hilfsmethode, die auch private Datenfelder sieht (über Getter)
    if (isset($obj->$prop)) {
        return htmlspecialchars($obj->$prop, ENT_QUOTES, 'UTF-8');
    }
    $getter = 'get' . ucfirst($prop);
    if (method_exists($obj, $getter)) {
        return htmlspecialchars($obj->$getter(), ENT_QUOTES, 'UTF-8');
    }
    return '';
}

$vorname = getField($v, 'vorname');
$nachname = getField($v, 'nachname');
$name = trim("$vorname $nachname");
$telefon = getField($v, 'telefon') ?: getField($v, 'phone') ?: getField($v, 'telefonnummer');
$email = getField($v, 'email');
$firma = getField($v, 'firma') ?: getField($v, 'company');
$position = getField($v, 'position') ?: getField($v, 'job');
$adresse = getField($v, 'adresse') ?: getField($v, 'address');
$website = getField($v, 'website') ?: getField($v, 'web');
$daten = $vorname . "\n" . $nachname . "\n" . $name . "\n" . $telefon . "\n" . $email . "\n" . $firma . "\n" . $position . "\n" . $adresse . "\n" . $website;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visitenkarte</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>
<body>
<div class="visitenkarte" style="border:1px solid #ccc;padding:16px;max-width:420px;font-family:Arial,Helvetica,sans-serif;">
    <header style="margin-bottom:8px;">
        <h2 style="margin:0;font-size:1.25rem;"><?php echo $name ?: 'Vorname Nachname'; ?></h2>
        <?php if ($position): ?><div style="color:#555;margin-top:4px;"><?php echo $position; ?></div><?php endif; ?>
        <?php if ($firma): ?><div style="font-weight:600;margin-top:4px;"><?php echo $firma; ?></div><?php endif; ?>
    </header>

    <section style="font-size:0.95rem;color:#222;">
        <?php if ($telefon): ?><div><strong>Tel:</strong> <?php echo $telefon; ?></div><?php endif; ?>
        <?php if ($email): ?><div><strong>Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div><?php endif; ?>
        <?php if ($adresse): ?><div><strong>Adresse:</strong> <?php echo $adresse; ?></div><?php endif; ?>
        <?php if ($website): ?>
            <?php $url = (strpos($website, 'http') === 0) ? $website : 'http://' . $website; ?>
            <div><strong>Web:</strong> <a href="<?php echo $url; ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($website); ?></a></div>
        <?php endif; ?>
    </section>

    <footer style="margin-top:12px;">
        <div style="display:inline-block;">
            <?php include('createpdf.php'); ?>
            <?php include('createqr.php'); ?>
        </div>
    </footer>
</div>

<script src="" async defer></script>
</body>
</html>
<!-- HTMl ausgabe der visitankarte -->
<!-- QR und PDF einbinden! -->