<?php

namespace Controllers\Router\Route;

use Controllers\CollectionController;

class RouteCollection extends ProtectedRoute
{
    /**
     * Initialise la route permettant d’accéder à la collection d’un utilisateur.
     *
     * @param string $action Nom de l'action liée à la route.
     * @param CollectionController $controller Contrôleur en charge de la collection.
     */
    public function __construct(string $action, CollectionController $controller)
    {
        parent::__construct($action, $controller);
    }

    /**
     * Gère la requête GET et affiche la collection de l'utilisateur.
     *
     * @param array $params Paramètres éventuels fournis à la route.
     */
    public function get(array $params = []): void
    {
        $this->controller->collection();
    }

    /**
     * Gère la requête POST en réutilisant la même logique que GET.
     *
     * @param array $params Paramètres éventuels fournis à la route.
     */
    public function post(array $params = []): void
    {
        $this->controller->collection();
    }
}
