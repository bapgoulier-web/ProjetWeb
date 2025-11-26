<?php


namespace Controllers;

use League\Plates\Engine;
use Models\UnitClass;
use Models\UnitClassDAO;

class UnitClassController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine('Views');
    }

    public function addUnitClass(array $data): void
    {
        $dao = new UnitClassDAO();
        $unitClass = new UnitClass();
        $unitClass->hydrate($data);

        $success = $dao->createUnitClass($unitClass);
        $message = $success ? "✅ Classe ajoutée avec succès !" : "❌ Erreur lors de l’ajout.";

        $controller = new MainController();
        $controller->index($message);
    }
}
