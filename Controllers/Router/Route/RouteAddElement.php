<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;

class RouteAddElement extends ProtectedRoute
{
    public function __construct(string $action, PersoController $controller)
    {
        // ✅ Route protégée : exige une connexion
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        // Cette route est protégée, donc si l'utilisateur n'est pas connecté,
        // la redirection vers login sera faite automatiquement par ProtectedRoute
        $this->controller->displayAddElement();
    }

    public function post(array $params = []): void
    {
        // (optionnel, pour traiter plus tard un formulaire)
    }
}
