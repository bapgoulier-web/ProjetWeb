<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Origin;
use Models\OriginDAO;

class OriginController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine('Views');
    }

    public function displayAddOrigin(?string $message = null): void
    {
        echo $this->templates->render('add-attribute', ['message' => $message]);
    }

    public function addOrigin(array $data): void
    {
        $dao = new OriginDAO();
        $origin = new Origin();
        $origin->hydrate($data);

        $success = $dao->createOrigin($origin);
        $message = $success ? "✅ Origine ajoutée avec succès !" : "❌ Erreur lors de l’ajout.";

        $controller = new MainController();
        $controller->index($message);
    }
}
