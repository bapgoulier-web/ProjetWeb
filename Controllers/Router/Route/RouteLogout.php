<?php

namespace Controllers\Router\Route;

use Controllers\AuthController;
use Controllers\Router\Route;

class RouteLogout extends Route
{
    protected $controller;

    public function __construct(string $action, AuthController $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        // Déconnexion simple
        $this->controller->logout();
    }

    public function post(array $params = []): void
    {
    }
}
