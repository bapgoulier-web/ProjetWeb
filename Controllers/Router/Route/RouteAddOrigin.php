<?php

namespace Controllers\Router\Route;

use Controllers\OriginController;
use Controllers\Router\Route;

class RouteAddOrigin extends Route
{
    protected $controller;

    /**
     * Initialise la route permettant d’ajouter une origine.
     */
    public function __construct(string $action, OriginController $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    /**
     * Affiche le formulaire d’ajout d’une origine.
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddOrigin();
    }

    /**
     * Traite l’ajout d’une origine en récupérant les données du formulaire.
     */
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
