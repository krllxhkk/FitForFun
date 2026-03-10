<?php
include "database.php";
include "header.php";

// lessen ophalen uit database
$stmt = $pdo->query("SELECT * FROM lessen");
$lessen = $stmt->fetchAll();
?>

<section class="lessen">

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

<p>Geen lessen beschikbaar.</p>

<?php endif; ?>

</div>

</section>

<?php include "footer.php"; ?>