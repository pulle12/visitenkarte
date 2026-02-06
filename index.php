<?php
require_once("vendor/autoload.php");
require_once("Visitenkarte.php");
$v = new Visitenkarte("Max", "Mustermann", "+43 123 456789", "max@mustermann.at", "Musterfirma GmbH", "Geschaeftsfuehrer", "Musterstrasse 1, 6020 Innsbruck", "www.musterfirma.at");
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
$daten = $name . "\n" . $telefon . "\n" . $email . "\n" . $firma . "\n" . $position . "\n" . $adresse . "\n" . $website;
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
<div style="border:1px solid #ccc;padding:16px;max-width:420px;font-family:Arial,Helvetica,sans-serif;">
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
        </div>
    </footer>
</div>
<div class="tools-panel">
    <?php include('createpdf.php'); ?>
    <?php include('createqr.php'); ?>
</div>


<script src="" async defer></script>
</body>
<style>
    .tools-panel {
        display: grid;
        grid-template-columns: 1fr 240px;
        gap: 16px;
        margin-top: 16px;
        align-items: start;
        max-width: 920px;
    }
    .tools-panel .card {
        background: #fff;
        border: 1px solid #e9e9e9;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(20,20,20,0.04);
        padding: 14px;
    }
    .tools-panel h3 {
        margin: 0 0 8px 0;
        font-size: 1rem;
        color: #222;
    }
    .pdf-preview {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .pdf-preview .preview {
        width: 100%;
        max-height: 320px;
        overflow: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fafafa;
        border-radius: 6px;
        padding: 8px;
        border: 1px solid #f0f0f0;
    }
    .pdf-preview a.btn {
        display: inline-block;
        padding: 8px 12px;
        background: #0078d4;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-size: 0.95rem;
    }
    .qr-box {
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
        justify-content: start;
    }
    .qr-box img {
        width: 180px;
        height: 180px;
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e6e6e6;
        padding: 8px;
    }
    .tools-meta {
        font-size: 0.85rem;
        color: #666;
    }
    @media (max-width: 760px) {
        .tools-panel { grid-template-columns: 1fr; }
        .qr-box img { width: 140px; height: 140px; }
    }
</style>
</html>
<!-- HTMl ausgabe der visitankarte -->
<!-- QR und PDF einbinden! -->