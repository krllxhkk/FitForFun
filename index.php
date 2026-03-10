<?php
include "database.php";
include "header.php";

$stmt = $pdo->query("SELECT * FROM lessen ORDER BY datum ASC");
$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
    <div class="hero-content">
        <h2>Train Hard. Feel Strong. 🔥</h2>
        <p>Welkom bij <strong>FitForFun</strong> – de plek waar motivatie, energie en resultaat samenkomen</p>
        <p>Verbeter je conditie, bouw kracht op en train samen met een community die jou motiveert</p>
        <a href="lessen.php" class="btn">Bekijk Onze Lessen</a>
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


<?php include "footer.php"; ?>