<?php
//Je n'utilise pas cette route j'ai deja ELement et Personnage.
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\OriginController;
use Controllers\ElementController;
use Controllers\UnitClassController;

class RouteAddAttribute extends Route
{
    private OriginController $originController;
    private ElementController $elementController;
    private UnitClassController $unitClassController;

    /**
     * Initialise la route et instancie les contrôleurs nécessaires.
     */
    public function __construct(string $action)
    {
        parent::__construct($action);
        $this->originController = new OriginController();
        $this->elementController = new ElementController();
        $this->unitClassController = new UnitClassController();
    }

    /**
     * Affiche le formulaire d'ajout d'origine (interface par défaut).
     */
    public function get(array $params = []): void
    {
        $this->originController->displayAddOrigin();
    }

    /**
     * Traite l'ajout d'un attribut (origine, élément ou classe).
     * Récupère le type, hydrate les données et appelle le bon contrôleur.
     */
    public function post(array $params = []): void
    {
        try {
            $type = parent::getParam($params, "type", false);
            $data = [
                "name" => parent::getParam($params, "name", false),
                "urlImg" => parent::getParam($params, "urlImg", true),
            ];

            switch ($type) {
                case "origin":
                    $this->originController->addOrigin($data);
                    break;
                case "element":
                    $this->elementController->addElement($data);
                    break;
                case "unitclass":
                    $this->unitClassController->addUnitClass($data);
                    break;
                default:
                    throw new \Exception("Type d’attribut inconnu !");
            }
        } catch (\Exception $e) {
            $this->originController->displayAddOrigin("⚠️ " . $e->getMessage());
        }
    }
}
