<?php

namespace Controllers;

use League\Plates\Engine;
use Helpers\Message;
use Models\Services\PersonnageService;
use Models\CollectionDAO;

class MainController
{
    private Engine $templates;
    private PersonnageService $service;

    public function __construct()
    {
        $this->templates = new Engine('Views');
        $this->service = new PersonnageService();
    }

    public function index(?Message $message = null): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 🔹 Récupération de tous les personnages
        $listPersonnage = $this->service->getAllPerso();

        // 🔹 Récupération des personnages déjà dans la collection (si connecté)
        $ownedIds = [];
        if (isset($_SESSION['userUID'])) {
            $collectionDAO = new CollectionDAO();
            $ownedIds = $collectionDAO->getUserCollection((int)$_SESSION['userUID']);
        }

        // 🔹 Affichage de la vue
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'ownedIds' => $ownedIds, // ✅ essentiel pour afficher + / -
            'message' => $message
        ]);
    }
}
