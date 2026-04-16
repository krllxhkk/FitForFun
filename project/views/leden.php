<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>

<section class="hero hero-small">
    <div class="hero-content">
        <h2>Leden Overzicht 👥</h2>
        <p>Voeg nieuwe leden toe en beheer het volledige ledenbestand van FitForFun.</p>
    </div>
</section>

<section class="crud-section">
    <h2>Nieuw lid toevoegen</h2>
    <?php if (!empty($data['fout'])): ?>
    <!-- Foutmelding tonen -->
    <div class="alert-box">
        <h3>Fout</h3>
        <p><?php echo htmlspecialchars($data['fout']); ?></p>
    </div>
<?php endif; ?>

    <form method="POST" class="crud-form" action="<?php echo URLROOT; ?>/public/index.php?url=leden/add">
        <input type="text" name="naam" placeholder="Naam" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefoon" placeholder="Telefoon">
        <button type="submit">Toevoegen</button>
    </form>

    <a class="btn" href="<?php echo URLROOT; ?>/public/index.php?url=leden/overzicht">Bekijk aantal leden per periode</a>

    <div class="crud-table-wrapper">
        <table class="crud-table">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Datum</th>
                <th>Actie</th>
            </tr>

            <?php foreach ($data['leden'] as $lid): ?>
                <tr>
    <td><?php echo $lid->id; ?></td>
    <td><?php echo htmlspecialchars($lid->naam ?? ''); ?></td>
    <td><?php echo htmlspecialchars($lid->email ?? ''); ?></td>
    <td><?php echo htmlspecialchars($lid->telefoon ?? ''); ?></td>
    <td><?php echo htmlspecialchars($lid->created_at ?? ''); ?></td>
    <td>
    <a class="btn" href="<?php echo URLROOT; ?>/public/index.php?url=leden/edit/<?php echo $lid->id; ?>">Edit</a>

    <a class="btn-delete"
       href="<?php echo URLROOT; ?>/public/index.php?url=leden/delete/<?php echo $lid->id; ?>"
       onclick="return confirm('Weet je het zeker?')">
       Delete
    </a>
</td>
</tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>

<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>