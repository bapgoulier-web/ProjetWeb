<?php
namespace Controllers;

use Models\PersonnageDAO;
use Models\CollectionDAO;

class CollectionController
{
    private PersonnageDAO $personnageDAO;
    private CollectionDAO $collectionDAO;

    /**
     * Initialise les DAO nécessaires pour gérer les personnages et la collection utilisateur.
     */
    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
        $this->collectionDAO = new CollectionDAO();
    }

    /**
     * Affiche la page de collection pour l'utilisateur connecté.
     * Vérifie la session, récupère les personnages possédés et les envoie à la vue.
     */
    public function collection(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['userUID'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $userId = $_SESSION['userUID'];
        $ownedIds = $this->collectionDAO->getUserCollection($userId);
        $listPersonnage = $this->personnageDAO->getByIds($ownedIds);

        echo (new \League\Plates\Engine('Views'))->render('collection', [
            'listPersonnage' => $listPersonnage
        ]);
    }

    /**
     * Ajoute un personnage à la collection de l'utilisateur.
     * Vérifie l'ID utilisateur et l'ID du personnage puis met à jour la collection.
     */
    public function addToCollection(array $params): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['userUID'] ?? null;
        $persoId = $params['id_perso'] ?? null;

        if ($userId && $persoId) {
            $this->collectionDAO->addToCollection((int)$userId, $persoId);
        }

        header("Location: index.php?action=index");
        exit;
    }

    /**
     * Retire un personnage de la collection de l'utilisateur.
     * Vérifie l'ID utilisateur et l'ID du personnage puis met à jour la base.
     */
    public function removeFromCollection(array $params): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['userUID'] ?? null;
        $persoId = $params['id_perso'] ?? null;

        if ($userId && $persoId) {
            $this->collectionDAO->removeFromCollection((int)$userId, $persoId);
        }

        header("Location: index.php?action=collection");
        exit;
    }
}
