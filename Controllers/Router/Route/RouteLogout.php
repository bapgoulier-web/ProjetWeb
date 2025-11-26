<?php

namespace Controllers\Router\Route;

use Controllers\AuthController;
use Controllers\Router\Route;

class RouteLogout extends Route
{
    protected $controller;

    /**
     * Initialise la route de déconnexion et stocke le contrôleur d'authentification.
     *
     * @param string $action Nom de l'action associée à la route.
     * @param AuthController $controller Contrôleur gérant l'authentification.
     */
    public function __construct(string $action, AuthController $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    /**
     * Exécute la déconnexion de l'utilisateur.
     *
     * @param array $params Paramètres éventuels passés à la route.
     */
    public function get(array $params = []): void
    {
        $this->controller->logout();
    }

    /**
     * Méthode POST redirigée vers la méthode GET (aucun traitement spécifique).
     *
     * @param array $params Paramètres éventuels passés à la route.
     */
    public function post(array $params = []): void
    {}
}
