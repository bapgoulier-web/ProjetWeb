<?php

namespace Controllers\Router\Route;

use Controllers\CollectionController;

class RouteAddToCollection extends ProtectedRoute
{
    public function get(array $params = []): void
    {
        (new CollectionController())->addToCollection($params);
    }

    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
