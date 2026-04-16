<?php
include "database.php";
include "header.php";

/* ZOEK VARIABELEN */
$zoek = $_GET['zoek'] ?? '';
$prijs = $_GET['prijs'] ?? '';
$datum = $_GET['datum'] ?? '';
$fout = '';

$params = [];
$lessen = [];

/* DATUM CHECK */
$today = date("Y-m-d");

if ($datum && $datum < $today) {
    $fout = "Je kan niet zoeken in het verleden!";
}

/* QUERY ALLEEN ALS GEEN FOUT */
if (!$fout) {

    try {
        $sql = "SELECT * FROM lessen WHERE 1";
        // $sql = "SELECT * FROM bestaat_niet"; // test database error

        // 🔍 zoeken op naam
        if ($zoek) {
            $sql .= " AND naam LIKE ?";
            $params[] = "%$zoek%";
        }

        // 💰 prijs filter
        if ($prijs) {
            $sql .= " AND prijs <= ?";
            $params[] = $prijs;
        }

        // 📅 datum filter
        if ($datum) {
            $sql .= " AND datum = ?";
            $params[] = $datum;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $fout = "Er is iets mis gegaan, probeer later opnieuw.";
    }
}
?>

<section class="lessen">

    <!-- 🔴 FOUTMELDING -->
    <?php if ($fout): ?>
        <div style="background:#e74c3c; padding:12px; border-radius:8px; color:white; margin-bottom:15px;">
            ⚠️ <?= $fout ?>
        </div>
    <?php endif; ?>

    <!-- 🔍 ZOEK FORM -->
    <form method="GET" class="search-form">

        <input type="text" name="zoek" placeholder="Zoek op les naam..."
            value="<?= htmlspecialchars($zoek) ?>">

        <input type="number" name="prijs" placeholder="Max prijs..."
            value="<?= htmlspecialchars($prijs) ?>">

        <input type="date" name="datum"
            value="<?= htmlspecialchars($datum) ?>">

        <button type="submit">Zoeken</button>

    </form>

    <h2>Aankomende Lessen</h2>
    <p>Bekijk hieronder onze geplande fitnesslessen en reserveer jouw plek.</p>

    <div class="lesson-container">

        <!-- ✅ RESULTATEN -->
        <?php if (!$fout && count($lessen) > 0): ?>

            <?php foreach ($lessen as $les): ?>

                <div class="lesson-card">

                    <img src="<?= htmlspecialchars($les['foto']) ?>" class="lesson-foto">

                    <h3><?= htmlspecialchars($les['naam']) ?></h3>

                    <p>📅 Datum: <?= date("d-m-Y", strtotime($les['datum'])) ?></p>

                    <p>⏰ Tijd: <?= date("H:i", strtotime($les['tijd'])) ?></p>

                    <p>💳 Prijs: €<?= number_format($les['prijs'], 2) ?></p>

                    <p><?= htmlspecialchars($les['beschikbaarheid']) ?></p>

                    <button class="btn">Reserveer</button>

                </div>

            <?php endforeach; ?>

            <!-- ❌ GEEN RESULTAAT -->
        <?php elseif (!$fout): ?>

            <p class="geen-lessen">
                Geen lessen gevonden
            </p>

        <?php endif; ?>

    </div>

</section>

<?php include "footer.php"; ?>