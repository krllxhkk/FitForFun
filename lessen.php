<?php
include "database.php";
include "header.php";

/* ZOEK VARIABELEN */
$zoek = $_GET['zoek'] ?? '';
$prijs = $_GET['prijs'] ?? '';

/* QUERY OPBOUWEN */
$sql = "SELECT * FROM lessen WHERE 1";
$params = [];

if($zoek){
    $sql .= " AND naam LIKE ?";
    $params[] = "%$zoek%";
}

if($prijs){
    $sql .= " AND prijs <= ?";
    $params[] = $prijs;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="lessen">

<!-- ZOEK FORM -->
<form method="GET" class="search-form">

<input type="text" name="zoek" placeholder="Zoek op les naam..."
value="<?= htmlspecialchars($zoek) ?>">

<input type="number" name="prijs" placeholder="Max prijs..."
value="<?= htmlspecialchars($prijs) ?>">

<button type="submit">Zoeken</button>

</form>

<h2>Aankomende Lessen</h2>
<p>Bekijk hieronder onze geplande fitnesslessen en reserveer jouw plek.</p>

<div class="lesson-container">

<?php if(count($lessen) > 0): ?>

<?php foreach($lessen as $les): ?>

<div class="lesson-card">

<img src="<?= htmlspecialchars($les['foto']) ?>" class="lesson-foto">

<h3><?= htmlspecialchars($les['naam']) ?></h3>

<p>📅 Datum: <?= date("d-m-Y", strtotime($les['datum'])) ?></p>

<p>⏰ Tijd: <?= date("H:i", strtotime($les['tijd'])) ?></p>

<p>💳 Prijs: €<?= number_format($les['prijs'],2) ?></p>

<p><?= htmlspecialchars($les['beschikbaarheid']) ?></p>

<button class="btn">Reserveer</button>

</div>

<?php endforeach; ?>

<?php else: ?>

<p class="geen-lessen">
Geen lessen gevonden
</p>

<?php endif; ?>

</div>

</section>

<?php include "footer.php"; ?>