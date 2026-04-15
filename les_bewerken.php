<?php
include "database.php";
include "header.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM lessen WHERE id = ?");
$stmt->execute([$id]);
$les = $stmt->fetch(PDO::FETCH_ASSOC);

$fout = '';
$dbError = ''; // 👈 echte database error

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $naam = $_POST['naam'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];
    $prijs = $_POST['prijs'];

    $today = date("Y-m-d");

    // ✅ VALIDATIE (unhappy scenario)
    if (empty($naam) || empty($datum) || empty($tijd) || empty($prijs)) {
        $fout = "Vul alle velden in!";
    } elseif ($prijs < 0) {
        $fout = "Prijs mag niet negatief zijn!";
    } elseif ($datum < $today) {
        $fout = "Er is iets mis gegaan, probeer later opnieuw.";
    } else {

        try {
            $sql = "UPDATE lessen SET naam=?, datum=?, tijd=?, prijs=? WHERE id=?";
<<<<<<< HEAD
           // $sql = "UPDATE bestaat_niet SET naam=? WHERE id=?"; // ❌ foutieve query voor testing

=======
            //$sql = "UPDATE bestaat_niet SET naam=? WHERE id=?"; //  test foutmelding
>>>>>>> feature/bestaande-les-wijzigen
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$naam, $datum, $tijd, $prijs, $id]);

            header("Location: lessen_overzicht.php");
            exit;
        } catch (PDOException $e) {

            // ✅ nette melding voor gebruiker
            $fout = "Er is een probleem met de database. Probeer later opnieuw.";

            // ✅ echte error voor docent
            $dbError = $e->getMessage();
        }
    }
}
?>

<section class="form-pagina">

    <h2>✏️ Les Bewerken</h2>

    <!-- ❗ nette fout -->
    <?php if ($fout): ?>
        <p style="color:red;"><?= $fout ?></p>
    <?php endif; ?>

    <!-- ❗ echte database fout (voor docent) -->
    <?php if ($dbError): ?>
        <p style="color:orange;">DEBUG: <?= $dbError ?></p>
    <?php endif; ?>

    <form method="POST" class="les-form">

        <label>Les naam</label>
        <input type="text" name="naam" value="<?= $les['naam'] ?>">

        <label>Datum</label>
        <input type="date" name="datum" value="<?= $les['datum'] ?>">

        <label>Tijd</label>
        <input type="time" name="tijd" value="<?= $les['tijd'] ?>">

        <label>Prijs</label>
        <input type="number" step="0.01" name="prijs" value="<?= $les['prijs'] ?>">

        <button type="submit" class="btn">Les opslaan</button>

    </form>

</section>

<?php include "footer.php"; ?>