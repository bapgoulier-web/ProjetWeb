<?php
namespace Controllers;

use Models\PersonnageDAO;
use Models\CollectionDAO;

class CollectionController
{
    private PersonnageDAO $personnageDAO;
    private CollectionDAO $collectionDAO;

    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
        $this->collectionDAO = new CollectionDAO();
    }

    // Affiche la page "Collection"
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

// Ajoute un perso à la collection
    public function addToCollection(array $params): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['userUID'] ?? null;
        $persoId = $params['id_perso'] ?? null; // ✅ clé du formulaire

        if ($userId && $persoId) {
            $this->collectionDAO->addToCollection((int)$userId, $persoId);
        }

        header("Location: index.php?action=index"); // ✅ retour à l’accueil
        exit;
    }

// Retire un perso de la collection
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

        header("Location: index.php?action=collection"); // ✅ retour vers la collection
        exit;
    }

}
