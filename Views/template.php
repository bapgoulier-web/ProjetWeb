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
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Personnages</a></li>
            <li><a href="#">Connexion</a></li>
        </ul>
    </nav>
</header>

<main id="contenu">
    <!-- Ici s’affichera le contenu spécifique à chaque page -->
    <?= $this->section('content') ?>
</main>

<footer>
    <p>© 2025 - Projet Mihoyo</p>
</footer>
</body>
</html>
