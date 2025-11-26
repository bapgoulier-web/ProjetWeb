<?php

namespace Controllers\Router\Route;

use Controllers\CollectionController;

class RouteCollection extends ProtectedRoute
{
    public function __construct(string $action, CollectionController $controller)
    {
        parent::__construct($action, $controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->collection();
    }

    public function post(array $params = []): void
    {
        $this->controller->collection();
    }
}
