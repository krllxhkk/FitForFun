<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>

<section class="hero-small">
    <div class="hero-content">
        <h2>Overzicht Aantal Leden Per Periode 📊</h2>
        <p>Kies een periode en bekijk hoeveel leden in die tijd zijn toegevoegd.</p>
    </div>
</section>

<section class="crud-section">
    <h2>Bereken leden per periode</h2>

    <form method="POST" class="crud-form" action="<?php echo URLROOT; ?>/public/index.php?url=leden/overzicht">
        <input type="date" name="van" required>
        <input type="date" name="tot" required>
        <button type="submit">Berekenen</button>
    </form>

    <?php if ($data['resultaat'] !== null): ?>
        <div class="info-card">
            <h3>Resultaat</h3>
            <p>Totaal aantal leden in deze periode: <strong><?php echo $data['resultaat']; ?></strong></p>
        </div>
    <?php endif; ?>

    <a class="back-link" href="<?php echo URLROOT; ?>/public/index.php?url=leden/index">← Terug naar leden overzicht</a>
</section>

<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>