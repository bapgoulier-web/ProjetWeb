<?php

namespace Controllers;

use League\Plates\Engine;
use Helpers\Message;
use Helpers\Logger;
use Models\PersonnageDAO;
use Models\CollectionDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Models\OriginDAO;
use Models\Personnage;

class PersoController
{
    private Engine $templates;
    private PersonnageDAO $personnageDAO;
    private CollectionDAO $collectionDAO;

    public function __construct()
    {
        $this->templates = new Engine('Views');
        $this->personnageDAO = new PersonnageDAO();
        $this->collectionDAO = new CollectionDAO();
    }

    /**
     * 🏠 Affiche la page Accueil avec les boutons + / –
     */
    public function accueil(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $userId = $_SESSION['userUID'] ?? 0;
        $listPersonnage = $this->personnageDAO->getAll();
        $ownedIds = $this->collectionDAO->getUserCollection($userId);

        echo $this->templates->render('accueil', [
            'listPersonnage' => $listPersonnage,
            'ownedIds' => $ownedIds
        ]);
    }

    /**
     * ➕ Ajoute un personnage dans la collection de l'utilisateur
     */
    public function addToCollection(string $persoId): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['userUID'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $userId = $_SESSION['userUID'];
        $this->collectionDAO->addToCollection($userId, $persoId);
        header("Location: index.php?action=accueil");
        exit;
    }

    /**
     * ➖ Retire un personnage de la collection de l'utilisateur
     */
    public function removeFromCollection(string $persoId): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['userUID'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $userId = $_SESSION['userUID'];
        $this->collectionDAO->removeFromCollection($userId, $persoId);
        header("Location: index.php?action=accueil");
        exit;
    }

    /**
     * ➕ Affiche le formulaire d’ajout d’un personnage
     */
    public function displayAddPerso(?string $message = null): void
    {
        $daoElement = new ElementDAO();
        $daoUnitClass = new UnitClassDAO();
        $daoOrigin = new OriginDAO();

        echo $this->templates->render('add-perso', [
            'message' => $message,
            'elements' => $daoElement->getAll(),
            'unitclasses' => $daoUnitClass->getAll(),
            'origins' => $daoOrigin->getAll()
        ]);
    }

    /**
     * ➕ Ajoute un nouveau personnage
     */
    public function addPerso(array $data): void
    {
        $logger = new Logger();

        try {
            $data['id'] = uniqid();
            $element = (new ElementDAO())->getById($data['element']);
            $unitclass = (new UnitClassDAO())->getById($data['unitclass']);
            $origin = !empty($data['origin']) ? (new OriginDAO())->getById($data['origin']) : null;

            $perso = new Personnage();
            $perso->setId($data['id']);
            $perso->setName($data['name']);
            $perso->setElement($element);
            $perso->setUnitclass($unitclass);
            $perso->setOrigin($origin);
            $perso->setRarity($data['rarity']);
            $perso->setUrlImg($data['urlImg']);

            $this->personnageDAO->createPersonnage($perso);
            $logger->log("CREATE", "Personnage ajouté : " . $perso->getName());

            header("Location: index.php?action=accueil");
            exit;
        } catch (\Exception $e) {
            $logger->log("ERROR", "Erreur d'ajout : " . $e->getMessage());
            $this->displayAddPerso("⚠️ " . $e->getMessage());
        }
    }

    /**
     * ✏️ Prépare la modification d’un personnage
     */
    public function displayEditPerso(string $idPerso = null): void
    {
        $daoPerso = new PersonnageDAO();
        $daoElement = new ElementDAO();
        $daoUnitClass = new UnitClassDAO();
        $daoOrigin = new OriginDAO();

        $personnage = $idPerso ? $daoPerso->getById($idPerso) : null;
        $message = $personnage ? null : "⚠️ Personnage introuvable.";

        echo $this->templates->render('add-perso', [
            'personnage' => $personnage,
            'elements' => $daoElement->getAll(),
            'unitclasses' => $daoUnitClass->getAll(),
            'origins' => $daoOrigin->getAll(),
            'message' => $message
        ]);
    }

    /**
     * 🧱 Met à jour un personnage
     */
    public function editPersoAndIndex(array $data): void
    {
        $logger = new Logger();

        try {
            $element = (new ElementDAO())->getById((int)$data['element']);
            $unitclass = (new UnitClassDAO())->getById((int)$data['unitclass']);
            $origin = !empty($data['origin']) ? (new OriginDAO())->getById((int)$data['origin']) : null;

            $perso = new Personnage();
            $perso->setId($data['id']);
            $perso->setName($data['name']);
            $perso->setElement($element);
            $perso->setUnitclass($unitclass);
            $perso->setOrigin($origin);
            $perso->setRarity($data['rarity']);
            $perso->setUrlImg($data['urlImg']);

            $this->personnageDAO->updatePerso($perso);
            $logger->log("UPDATE", "Personnage mis à jour : " . $perso->getName());

            header("Location: index.php?action=accueil");
            exit;
        } catch (\Exception $e) {
            $logger->log("ERROR", "Erreur de mise à jour : " . $e->getMessage());
            $this->displayEditPerso("⚠️ " . $e->getMessage());
        }
    }

    /**
     * 🗑️ Supprime un personnage
     */
    public function deletePersoAndIndex(?string $idPerso = null): void
    {
        $dao = new PersonnageDAO();
        $logger = new Logger();

        if ($idPerso && $dao->deletePerso($idPerso)) {
            $logger->log("DELETE", "Personnage supprimé (ID : $idPerso)");
        } else {
            $logger->log("ERROR", "Suppression échouée (ID : $idPerso)");
        }

        header("Location: index.php?action=accueil");
        exit;
    }

    public function displayAddElement(): void
    {
        echo $this->templates->render('add-perso-element');
    }

}
