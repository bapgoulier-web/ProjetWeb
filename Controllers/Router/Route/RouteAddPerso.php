<?php
namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route\ProtectedRoute;
use Exception;

class RouteAddPerso extends ProtectedRoute
{
    protected $controller;

    /**
     * Initialise la route permettant d’ajouter un personnage.
     */
    public function __construct(string $action, PersoController $controller)
    {
        parent::__construct($action, $controller);
    }

    /**
     * Affiche le formulaire vide d’ajout de personnage.
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddPerso();
    }

    /**
     * Récupère les données du formulaire et ajoute un personnage.
     * Gère également les erreurs pour afficher un message approprié.
     */
    public function post(array $params = []): void
    {
        try {
            $data = [
                "name"      => parent::getParam($params, "name", false),
                "element"   => intval(parent::getParam($params, "element", false)),
                "unitclass" => intval(parent::getParam($params, "unitclass", false)),
                "origin"    => intval(parent::getParam($params, "origin", true)),
                "rarity"    => intval(parent::getParam($params, "rarity", false)),
                "urlImg"    => parent::getParam($params, "urlImg", false),
            ];

            $this->controller->addPerso($data);
        } catch (Exception $e) {
            $this->controller->displayAddPerso("⚠️ Erreur : " . $e->getMessage());
        }
    }
}
