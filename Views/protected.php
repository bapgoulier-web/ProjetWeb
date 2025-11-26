<?php
$this->layout('template', ['title' => 'Page protégée']);
?>

<h1>Zone protégée 🔒</h1>
<p>Bienvenue <?= $_SESSION['username'] ?? 'inconnu' ?> !</p>

<a href="index.php?action=logout">Se déconnecter</a>
