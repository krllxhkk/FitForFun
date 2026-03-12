<?php
include "database.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM lessen WHERE id=?");
$stmt->execute([$id]);

header("Location: lessen_overzicht.php");
?>