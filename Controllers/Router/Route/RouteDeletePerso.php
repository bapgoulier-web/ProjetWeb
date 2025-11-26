<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;
use Exception;

class RouteDeletePerso extends Route
{
    protected $controller;

    public function __construct(string $action, PersoController $controller)
    {
        parent::__construct($action, $controller);
        $this->controller = $controller;
    }

    public function get(array $params = []): void
    {
        try {
            // Récupérer l'ID depuis l'URL (GET)
            $idPerso = parent::getParam($params, "idPerso", false);
            $this->controller->deletePersoAndIndex($idPerso);
        } catch (\Exception $e) {
            // En cas d’erreur (id manquant)
            $this->controller->deletePersoAndIndex();
        }
    }


    public function post(array $params = []): void{}
}
