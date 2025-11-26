<?php
require_once 'Helpers/Psr4AutoloaderClass.php';

$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();

// Namespaces
$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('Config', 'Config');
$loader->addNamespace('League\Plates', 'Vendor/Plates/Plates/src');
$loader->addNamespace('Controllers\Router', 'Controllers/Router');
$loader->addNamespace('Controllers\Router\Route', 'Controllers/Router/Route');

use Controllers\Router\Router;

// Création et exécution du routeur
$router = new Router();
$router->routing($_GET, $_POST);
