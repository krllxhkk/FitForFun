<?php
include "database.php";
include "header.php";

$stmt = $pdo->query("SELECT * FROM Les WHERE Isactief = 1 ORDER BY Datum ASC");
$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
    <div class="hero-content">
        <h2>Train Hard. Feel Strong. 🔥</h2>
        <p>Welkom bij <strong>FitForFun</strong> – de plek waar motivatie, energie en resultaat samenkomen.</p>
        <p>Verbeter je conditie, bouw kracht op en train samen met een community die jou motiveert.</p>
        <a href="#lessen" class="btn">Bekijk Onze Lessen</a>
    </div>
</section>

<section class="about">
    <h2>Waarom FitForFun?</h2>

    <p>
        Bij FitForFun geloven we dat sporten leuk, motiverend en effectief moet zijn.
        Onze moderne fitnesslessen zijn ontworpen om je sterker, fitter en energieker te maken.
    </p>

    <p>
        Of je nu beginner bent of een ervaren sporter, onze professionele trainers
        helpen je om jouw persoonlijke doelen te bereiken.
    </p>

    <p>
        Sluit je aan bij onze community en ontdek hoe leuk sporten kan zijn!
    </p>
</section>

<section class="about">
    <h2>Wat bieden wij?</h2>

    <div class="lesson-container">

        <div class="lesson-card">
            <h3>💪 Moderne apparatuur</h3>
            <p>Train met de nieuwste fitnessapparatuur voor maximale prestaties.</p>
        </div>

        <div class="lesson-card">
            <h3>🔥 Groepslessen</h3>
            <p>Energieke groepslessen die je motiveren om het beste uit jezelf te halen.</p>
        </div>

        <div class="lesson-card">
            <h3>🏆 Professionele trainers</h3>
            <p>Onze trainers begeleiden je en helpen je jouw fitnessdoelen te bereiken.</p>
        </div>

    </div>
</section>

<section id="lessen" class="lessen">
    <h2>Aankomende Lessen</h2>

    <p>Bekijk hieronder onze geplande fitnesslessen en reserveer jouw plek.</p>

    <div class="lesson-container">
        <?php foreach ($lessen as $les): ?>
            <div class="lesson-card">
                <h3><?= htmlspecialchars($les['Naam']) ?></h3>

                <p>
                    <strong>📅 Datum:</strong>
                    <?= date("d-m-Y", strtotime($les['Datum'])) ?>
                </p>

                <p>
                    <strong>🕒 Tijd:</strong>
                    <?= date("H:i", strtotime($les['Tijd'])) ?>
                </p>

                <p>
                    <strong>💶 Prijs:</strong>
                    €<?= number_format($les['Prijs'], 2) ?>
                </p>

                <p class="status">
                    <?= htmlspecialchars($les['Beschikbaarheid']) ?>
                </p>

                <a href="#" class="btn">Reserveer</a>

            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include "footer.php"; ?>