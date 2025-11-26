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

    /**
     * Initialise le moteur de templates et le service associé aux personnages.
     */
    public function __construct()
    {
        $this->templates = new Engine('Views');
        $this->service = new PersonnageService();
    }

    /**
     * Affiche la page d’accueil avec la liste des personnages
     * et indique lesquels appartiennent déjà à l’utilisateur connecté.
     *
     * @param Message|null $message Message optionnel à afficher.
     */
    public function index(?Message $message = null): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Récupération de tous les personnages
        $listPersonnage = $this->service->getAllPerso();

        // Récupération de la collection utilisateur si connecté
        $ownedIds = [];
        if (isset($_SESSION['userUID'])) {
            $collectionDAO = new CollectionDAO();
            $ownedIds = $collectionDAO->getUserCollection((int)$_SESSION['userUID']);
        }

        // Affiche la vue d’accueil
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'ownedIds' => $ownedIds,
            'message' => $message
        ]);
    }
}
