<?php
include "database.php";
include "header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM lessen WHERE id = ?");
$stmt->execute([$id]);
$les = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){

$naam = $_POST['naam'];
$datum = $_POST['datum'];
$tijd = $_POST['tijd'];
$prijs = $_POST['prijs'];

$sql = "UPDATE lessen SET naam=?, datum=?, tijd=?, prijs=? WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$naam,$datum,$tijd,$prijs,$id]);

header("Location: lessen_overzicht.php");
exit;
}
?>

<section class="form-pagina">

<h2>✏️ Les Bewerken</h2>

<form method="POST" class="les-form">

<label>Les naam</label>
<input type="text" name="naam" value="<?= $les['naam'] ?>" required>

<label>Datum</label>
<input type="date" name="datum" value="<?= $les['datum'] ?>" required>

<label>Tijd</label>
<input type="time" name="tijd" value="<?= $les['tijd'] ?>" required>

<label>Prijs</label>
<input type="number" step="0.01" name="prijs" value="<?= $les['prijs'] ?>" required>

<button type="submit" class="btn">Les opslaan</button>

</form>

</section>

<?php include "footer.php"; ?>