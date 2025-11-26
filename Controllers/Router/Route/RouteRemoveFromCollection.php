<?php

namespace Controllers\Router\Route;

use Controllers\CollectionController;

class RouteRemoveFromCollection extends ProtectedRoute
{
    /**
     * Traite la requête GET pour retirer un personnage de la collection.
     * Appelle directement le CollectionController avec les paramètres reçus.
     */
    public function get(array $params = []): void
    {
        (new CollectionController())->removeFromCollection($params);
    }

    /**
     * Traite la requête POST en réutilisant la logique du GET.
     * Permet de gérer les deux types de requêtes de la même manière.
     */
    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
