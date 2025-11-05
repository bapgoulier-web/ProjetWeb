<?php
require_once 'Helpers/Psr4AutoloaderClass.php';

// Initialisation de l’autoloader
$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();

// Enregistrement des namespaces
$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('League\Plates', 'Vendor/Plates/Plates/src');
$loader->addNamespace('Config', 'Config');


use Controllers\MainController; // 🔹 On importe notre contrôleur
// Création du contrôleur principal
$controller = new MainController();

// Appel de la méthode index() → affichera la page home
$controller->index();
