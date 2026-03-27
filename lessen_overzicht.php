<?php
include "database.php";
include "header.php";

$stmt = $pdo->query("SELECT * FROM lessen");
$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 style="text-align:center;">Lessen Overzicht</h2>

<div style="text-align:center; margin-top:20px;">
<a href="les_toevoegen.php" class="btn">➕ Nieuwe les toevoegen</a>
</div>

<table class="lessen-tabel">

<tr>
<th>Naam</th>
<th>Datum</th>
<th>Tijd</th>
<th>Prijs</th>
<th>Acties</th>
</tr>

<?php foreach($lessen as $les): ?>

<tr>

<td><?= htmlspecialchars($les['naam']) ?></td>

<td><?= date("d-m-Y", strtotime($les['datum'])) ?></td>

<td><?= date("H:i", strtotime($les['tijd'])) ?></td>

<td>€<?= number_format($les['prijs'],2) ?></td>

<td class="actie">

<a class="bewerken" href="les_bewerken.php?id=<?= $les['id'] ?>">Bewerken</a>

<a class="verwijderen" href="les_verwijderen.php?id=<?= $les['id'] ?>">Verwijderen</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<?php include "footer.php"; ?>