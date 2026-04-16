<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>

<section class="hero-small">
    <div class="hero-content">
        <h2>Medewerker bewerken ✏️</h2>
    </div>
</section>

<section class="crud-section">
    <h2>Gegevens aanpassen</h2>
    <?php if (!empty($data['fout'])): ?>
    <div class="alert-box">
        <h3>Fout</h3>
        <p><?php echo htmlspecialchars($data['fout']); ?></p>
    </div>
<?php endif; ?>

    <form method="POST" class="crud-form">
        <input type="text" name="naam" value="<?php echo $data['medewerker']->naam; ?>" required>
        <input type="text" name="functie" value="<?php echo $data['medewerker']->functie; ?>" required>
        <input type="email" name="email" value="<?php echo $data['medewerker']->email; ?>" required>
        <input type="text" name="telefoon" value="<?php echo $data['medewerker']->telefoon; ?>">

        <button type="submit">Opslaan</button>
    </form>

    <a class="back-link" href="<?php echo URLROOT; ?>/public/index.php?url=medewerker/index">← Terug</a>
</section>

<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>