<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>
    <link rel="stylesheet" href="public/css/main.css">
</head>

<body>

<header>
    <nav>
        <a href="index.php?action=index">Accueil</a>

        <?php if (isset($_SESSION['userUID'])): ?>
            <a href="index.php?action=collection">Collection</a>
        <?php endif; ?>

        <a href="index.php?action=add-perso">Ajouter Personnage</a>
        <a href="index.php?action=add-perso-element">Ajouter Élément</a>
        <a href="index.php?action=logs">Logs</a>

        <?php if (isset($_SESSION['userUID'])): ?>
            <a href="index.php?action=logout">🔒 Déconnexion</a>
        <?php else: ?>
            <a href="index.php?action=login">🔑 Connexion</a>
        <?php endif; ?>
    </nav>
</header>

<main id="contenu">
    <?= $this->section('content') ?>
</main>

<footer>
    <p>© 2025 - Projet Mihoyo</p>
</footer>

</body>
</html>
