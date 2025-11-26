<?php

namespace Controllers\Router\Route;

use Controllers\AuthController;
use Controllers\Router\Route;

class RouteLogin extends Route
{
    protected $controller;

    public function __construct(string $action, AuthController $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        // Affiche le formulaire de connexion
        $this->controller->displayLogin();
    }

    public function post(array $params = []): void
    {
        // Récupère les champs du formulaire
        $username = parent::getParam($params, "username", false);
        $password = parent::getParam($params, "password", false);

        // Appelle la méthode login du contrôleur
        $this->controller->login([
            "username" => $username,
            "password" => $password
        ]);
    }
}
