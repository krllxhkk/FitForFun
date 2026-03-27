<?php
include "database.php";
include "header.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$naam = $_POST['naam'];
$datum = $_POST['datum'];
$tijd = $_POST['tijd'];
$prijs = $_POST['prijs'];

$sql = "INSERT INTO lessen (naam, datum, tijd, prijs) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$naam, $datum, $tijd, $prijs]);

header("Location: lessen_overzicht.php");
exit;
}
?>

<section class="form-pagina">

<h2>➕ Nieuwe Les Toevoegen</h2>

<form method="POST" class="les-form">

<label>Les naam</label>
<input type="text" name="naam" required>

<label>Datum</label>
<input type="date" name="datum" required>

<label>Tijd</label>
<input type="time" name="tijd" required>

<label>Prijs</label>
<input type="number" step="0.01" name="prijs" required>

<button type="submit" class="btn">Les opslaan</button>

</form>

</section>

<?php include "footer.php"; ?>