<?php
include "database.php";
include "header.php";

$fout = '';
$lessen = [];

try {
    $stmt = $pdo->query("SELECT * FROM lessen");
    $lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $fout = "Er is iets mis gegaan, probeer later opnieuw.";
}
?>

<main>

    <h2 style="text-align:center;">Lessen Overzicht</h2>

    <!-- ➕ Nieuwe les -->
    <div style="text-align:center; margin-top:20px;">
        <a href="les_toevoegen.php" class="btn">➕ Nieuwe les toevoegen</a>
    </div>

    <!-- ❗ FOUTMELDING -->
    <?php if (!empty($fout)): ?>
        <div style="background:#e74c3c; padding:12px; border-radius:8px; color:white; text-align:center; margin:20px;">
            ⚠️ <?= $fout ?>
        </div>
    <?php endif; ?>

    <table class="lessen-tabel">

        <tr>
            <th>Naam</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Prijs</th>
            <th>Acties</th>
        </tr>

        <?php if (!empty($lessen)): ?>

            <?php foreach ($lessen as $les): ?>

                <tr>

                    <td><?= htmlspecialchars($les['naam']) ?></td>

                    <td><?= date("d-m-Y", strtotime($les['datum'])) ?></td>

                    <td><?= date("H:i", strtotime($les['tijd'])) ?></td>

                    <td>€<?= number_format($les['prijs'], 2) ?></td>

                    <td class="actie">

                        <a class="bewerken" href="les_bewerken.php?id=<?= $les['id'] ?>">
                            Bewerken
                        </a>

                        <a class="verwijderen"
                            href="les_verwijderen.php?id=<?= $les['id'] ?>"
                            onclick="return confirm('Weet je zeker dat je wilt verwijderen?')">
                            Verwijderen
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="5" style="text-align:center; padding:20px;">
                    Geen lessen gevonden
                </td>
            </tr>

        <?php endif; ?>

    </table>

</main>

<?php include "footer.php"; ?>