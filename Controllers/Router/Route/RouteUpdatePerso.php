<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;
use Exception;

class RouteUpdatePerso extends Route
{
    protected $controller;

    /**
     * Constructeur : initialise la route et le contrôleur associé.
     */
    public function __construct(string $action, PersoController $controller)
    {
        parent::__construct($action, $controller);
        $this->controller = $controller;
    }

    /**
     * Gère la requête GET :
     * - récupère l’ID du personnage
     * - affiche le formulaire d’édition
     */
    public function get(array $params = []): void
    {
        try {
            $idPerso = parent::getParam($params, "idPerso", false);
            $this->controller->displayEditPerso($idPerso);
        } catch (Exception $e) {
            $this->controller->displayEditPerso("Erreur : ID de personnage introuvable");
        }
    }

    /**
     * Gère la requête POST :
     * - récupère les données du formulaire
     * - prépare les données du personnage à modifier
     * - appelle la méthode d’update dans le contrôleur
     */
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
