<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>

<section class="hero-small">
    <div class="hero-content">
        <h2>Medewerker Overzicht 🧑‍💼</h2>
        <p>Voeg nieuwe medewerkers toe en beheer het medewerkersbestand van FitForFun.</p>
    </div>
</section>

<section class="crud-section">
    <h2>Nieuwe medewerker toevoegen</h2>

    <form method="POST" class="crud-form" action="<?php echo URLROOT; ?>/public/index.php?url=medewerker/add">
        <input type="text" name="naam" placeholder="Naam" required>
        <input type="text" name="functie" placeholder="Functie" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telefoon" placeholder="Telefoon">
        <button type="submit">Toevoegen</button>
    </form>

    <div class="crud-table-wrapper">
        <table class="crud-table">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Functie</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Actie</th>
            </tr>

            <?php foreach ($data['medewerkers'] as $medewerker): ?>
                <tr>
                    <td><?php echo $medewerker->id; ?></td>
                    <td><?php echo htmlspecialchars($medewerker->naam ?? ''); ?></td>
<td><?php echo htmlspecialchars($medewerker->functie ?? ''); ?></td>
<td><?php echo htmlspecialchars($medewerker->email ?? ''); ?></td>
<td><?php echo htmlspecialchars($medewerker->telefoon ?? ''); ?></td>
                    <td>
                    <a class="btn" href="<?php echo URLROOT; ?>/public/index.php?url=medewerker/edit/<?php echo $medewerker->id; ?>">Edit</a>    
                    <a class="btn-delete" href="<?php echo URLROOT; ?>/public/index.php?url=medewerker/delete/<?php echo $medewerker->id; ?>" onclick="return confirm('Weet je het zeker?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</section>

<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>