<?php

namespace Controllers\Router\Route;

use Controllers\MainController;
use Controllers\Router\Route;

/**
 * RouteIndex gère la route principale (index)
 */
class RouteIndex extends ProtectedRoute
{
    protected $controller;

    public function __construct(string $action, MainController $controller)
    {
        parent::__construct($action, $controller);
        $this->controller = $controller;
    }

    /**
     * Si la méthode GET est appelée, on charge la page d’accueil
     */
    public function get(array $params = []): void
    {
        $this->controller->index();
    }

    /**
     * Si la méthode POST est appelée, on peut ici rediriger vers la même action
     */
    public function post(array $params = []): void
    {
        $this->controller->index();
    }
}
