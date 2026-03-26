<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>

<section class="hero-small">
    <div class="hero-content">
        <h2>Lid op achternaam zoeken 🔎</h2>
        <p>Zoek snel een lid op naam of achternaam binnen FitForFun.</p>
    </div>
</section>

<section class="crud-section">
    <h2>Zoeken</h2>

    <form method="POST" class="crud-form" action="<?php echo URLROOT; ?>/public/index.php?url=leden/zoeken">
        <input 
            type="text" 
            name="zoekterm" 
            placeholder="Voer achternaam in"
            value="<?php echo htmlspecialchars($data['zoekterm'] ?? ''); ?>"
            required
        >
        <button type="submit">Zoeken</button>
    </form>

    <?php if (($data['zoekterm'] ?? '') !== ''): ?>
        <div class="crud-table-wrapper">
            <table class="crud-table">
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th>Datum</th>
                </tr>

                <?php if (!empty($data['resultaten'])): ?>
                    <?php foreach ($data['resultaten'] as $lid): ?>
                        <tr>
                            <td><?php echo $lid->id; ?></td>
                            <td><?php echo htmlspecialchars($lid->naam ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($lid->email ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($lid->telefoon ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($lid->created_at ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Geen leden gevonden.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>