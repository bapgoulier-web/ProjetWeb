<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;
use Exception;

class RouteUpdatePerso extends Route
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
            $idPerso = parent::getParam($params, "idPerso", false);
            $this->controller->displayEditPerso($idPerso);
        } catch (Exception $e) {
            $this->controller->displayEditPerso("Erreur : ID de personnage introuvable");
        }
    }

    public function post(array $params = []): void
    {
        try {
            $data = [
                "id"        => parent::getParam($params, "id", false),
                "name"      => parent::getParam($params, "name", false),
                "element"   => intval(parent::getParam($params, "element", false)),
                "unitclass" => intval(parent::getParam($params, "unitclass", false)),
                "origin"    => intval(parent::getParam($params, "origin", true)),
                "rarity"    => parent::getParam($params, "rarity", false),
                "urlImg"    => parent::getParam($params, "urlImg", false)
            ];

            $this->controller->editPersoAndIndex($data);
        } catch (Exception $e) {
            $this->controller->displayEditPerso("⚠️ Erreur lors de la mise à jour : " . $e->getMessage());
        }
    }
}
