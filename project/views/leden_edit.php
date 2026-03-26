<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>

<section class="hero-small">
    <div class="hero-content">
        <h2>Lid bewerken ✏️</h2>
        <p>Pas de gegevens van het lid aan.</p>
    </div>
</section>

<section class="crud-section">
    <h2>Gegevens aanpassen</h2>

    <form method="POST" class="crud-form">
        <input type="text" name="naam" value="<?php echo htmlspecialchars($data['lid']->naam ?? ''); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($data['lid']->email ?? ''); ?>" required>
        <input type="text" name="telefoon" value="<?php echo htmlspecialchars($data['lid']->telefoon ?? ''); ?>">
        <button type="submit">Opslaan</button>
    </form>

    <a class="back-link" href="<?php echo URLROOT; ?>/public/index.php?url=leden/index">← Terug</a>
</section>

<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>