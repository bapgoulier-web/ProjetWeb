<?php

namespace Controllers\Router\Route;

use Controllers\CollectionController;

class RouteAddToCollection extends ProtectedRoute
{
    /**
     * Ajoute un personnage à la collection de l’utilisateur.
     * Appelle directement le contrôleur CollectionController.
     */
    public function get(array $params = []): void
    {
        (new CollectionController())->addToCollection($params);
    }

    /**
     * Redirige la requête POST vers la logique GET.
     */
    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
