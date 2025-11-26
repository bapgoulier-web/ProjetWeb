<?php

namespace Controllers;

use League\Plates\Engine;
use Models\Origin;
use Models\OriginDAO;

class OriginController
{
    private Engine $templates;

    /**
     * Constructeur : initialise le moteur de templates.
     */
    public function __construct()
    {
        $this->templates = new Engine('Views');
    }

    /**
     * Affiche le formulaire d'ajout d'une origine.
     *
     * @param string|null $message Message éventuel à afficher.
     */
    public function displayAddOrigin(?string $message = null): void
    {
        echo $this->templates->render('add-attribute', ['message' => $message]);
    }

    /**
     * Ajoute une nouvelle origine en base de données.
     *
     * @param array $data Données envoyées par le formulaire.
     */
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
