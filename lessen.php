<?php
include "database.php";
include "header.php";

$zoek = $_GET['zoek'] ?? '';

if($zoek){
    $stmt = $pdo->prepare("SELECT * FROM lessen WHERE naam LIKE ?");
    $stmt->execute(["%$zoek%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM lessen");
}

$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="lessen">

<form method="GET" class="search-form">
    <input type="text" name="zoek" placeholder="Zoek op les naam..."
    value="<?= htmlspecialchars($_GET['zoek'] ?? '') ?>">
    <button type="submit">Zoeken</button>
</form>


<h2>Aankomende Lessen</h2>
<p>Bekijk hieronder onze geplande fitnesslessen en reserveer jouw plek.</p>

<div class="lesson-container">

<?php if(count($lessen) > 0): ?>

<?php foreach($lessen as $les): ?>

<div class="lesson-card">

<h3><?= htmlspecialchars($les['naam']) ?></h3>

<p>📅 Datum: <?= htmlspecialchars($les['datum']) ?></p>

<p>⏰ Tijd: <?= htmlspecialchars($les['tijd']) ?></p>

<p>💳 Prijs: €<?= number_format($les['prijs'],2) ?></p>

<p><?= htmlspecialchars($les['beschikbaarheid']) ?></p>

<button class="btn">Reserveer</button>

</div>

<?php endforeach; ?>

<?php else: ?>

<p class="geen-lessen">
Geen lessen gevonden voor "<?= htmlspecialchars($zoek) ?>"
</p>
<?php endif; ?>

</div>

</section>

<?php include "footer.php"; ?>