<?php

namespace Controllers\Router\Route;

use Controllers\CollectionController;

class RouteRemoveFromCollection extends ProtectedRoute
{
    public function get(array $params = []): void
    {
        (new CollectionController())->removeFromCollection($params);
    }

    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
