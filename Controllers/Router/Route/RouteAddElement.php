<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;

class RouteAddElement extends ProtectedRoute
{
    /**
     * Initialise la route protégée pour ajouter un élément.
     */
    public function __construct(string $action, PersoController $controller)
    {
        parent::__construct($action, $controller);
    }

    /**
     * Affiche le formulaire d'ajout d'un élément.
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddElement();
    }

    /**
     * Méthode POST (aucun traitement pour le moment).
     */
    public function post(array $params = []): void
    {
    }
}
