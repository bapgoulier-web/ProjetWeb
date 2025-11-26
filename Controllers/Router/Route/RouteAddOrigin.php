<?php


namespace Controllers\Router\Route;

use Controllers\OriginController;
use Controllers\Router\Route;

class RouteAddOrigin extends Route
{
    protected $controller;

    public function __construct(string $action, OriginController $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddOrigin();
    }

    public function post(array $params = []): void
    {
        try {
            $data = [
                'name' => parent::getParam($params, "name", false),
                'urlImg' => parent::getParam($params, "urlImg", true),
            ];
            $this->controller->addOrigin($data);
        } catch (\Exception $e) {
            $this->controller->displayAddOrigin("⚠️ " . $e->getMessage());
        }
    }
}
