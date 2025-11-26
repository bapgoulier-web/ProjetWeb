<?php


namespace Controllers;

use League\Plates\Engine;
use Models\Element;
use Models\ElementDAO;

class ElementController
{
    private Engine $templates;

    public function __construct()
    {
        $this->templates = new Engine('Views');
    }

    public function addElement(array $data): void
    {
        $dao = new ElementDAO();
        $element = new Element();
        $element->hydrate($data);

        $success = $dao->createElement($element);
        $message = $success ? "✅ Élément ajouté avec succès !" : "❌ Erreur lors de l’ajout.";

        $controller = new MainController();
        $controller->index($message);
    }
}
