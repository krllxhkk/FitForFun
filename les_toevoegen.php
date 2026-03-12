<?php
include "database.php";

if($_POST){

$naam = $_POST['naam'];
$datum = $_POST['datum'];
$tijd = $_POST['tijd'];
$prijs = $_POST['prijs'];

$sql = "INSERT INTO lessen (naam, datum, tijd, prijs) VALUES (?, ?, ?, ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$naam,$datum,$tijd,$prijs]);

header("Location: lessen_overzicht.php");
}
?>

<h2>Nieuwe Les</h2>

<form method="POST">

Naam
<input type="text" name="naam">

Datum
<input type="date" name="datum">

Tijd
<input type="time" name="tijd">

Prijs
<input type="number" name="prijs">

<button type="submit">Opslaan</button>

</form>