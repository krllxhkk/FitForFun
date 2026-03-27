<?php require_once APPROOT . '/views/partials/mvc_header.php'; ?>
<h2>Accounts Overzicht</h2>

<form method="POST" action="/accounts/add">

<input type="text" name="naam" placeholder="Naam">
<input type="text" name="email" placeholder="Email">
<input type="text" name="telefoon" placeholder="Telefoon">

<button type="submit">Toevoegen</button>

</form>

<hr>

<table border="1">

<tr>
<th>Naam</th>
<th>Email</th>
<th>Telefoon</th>
<th>Actie</th>
</tr>

<?php foreach($data['accounts'] as $account) : ?>

<tr>

<td><?= $account->naam ?></td>
<td><?= $account->email ?></td>
<td><?= $account->telefoon ?></td>

<td>
<a href="/accounts/delete/<?= $account->id ?>">Delete</a>
</td>

</tr>

<?php endforeach; ?>

</table>
<?php require_once APPROOT . '/views/partials/mvc_footer.php'; ?>