<?php
include "database.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM lessen WHERE id=?");
$stmt->execute([$id]);
$les = $stmt->fetch();

if($_POST){

$naam = $_POST['naam'];
$datum = $_POST['datum'];
$tijd = $_POST['tijd'];
$prijs = $_POST['prijs'];

$sql = "UPDATE lessen SET naam=?, datum=?, tijd=?, prijs=? WHERE id=?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$naam,$datum,$tijd,$prijs,$id]);

header("Location: lessen_overzicht.php");
}
?>

<div class="form-container">

<h2>Les Bewerken</h2>

<form method="POST">

<div class="form-group">
<label>Les naam</label>
<input type="text" name="naam" value="<?= $les['naam'] ?>">
</div>

<div class="form-group">
<label>Datum</label>
<input type="date" name="datum" value="<?= $les['datum'] ?>">
</div>

<div class="form-group">
<label>Tijd</label>
<input type="time" name="tijd" value="<?= $les['tijd'] ?>">
</div>

<div class="form-group">
<label>Prijs</label>
<input type="number" name="prijs" value="<?= $les['prijs'] ?>">
</div>

<button class="form-btn">Les opslaan</button>

</form>

</div>