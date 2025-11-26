<?php

namespace Models\Services;

use Models\ElementDAO;
use Models\OriginDAO;
use Models\Personnage;
use Models\PersonnageDAO;
use Models\UnitClassDAO;

class PersonnageService
{
    private PersonnageDAO $personnageDAO;
    private OriginDAO $originDAO;
    private ElementDAO $elementDAO;
    private UnitClassDAO $unitClassDAO;

    /**
     * Initialise les DAO nécessaires au service.
     */
    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
        $this->originDAO = new OriginDAO();
        $this->elementDAO = new ElementDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }

    /**
     * Récupère tous les personnages complets (avec leurs attributs associés).
     *
     * @return array Liste des objets Personnage entièrement hydratés.
     */
    public function getAllPerso(): array
    {
        $persosData = $this->personnageDAO->getAll();
        $persos = [];

        foreach ($persosData as $data) {
            $element = $this->elementDAO->getById($data['element']);
            $origin = $this->originDAO->getById($data['origin']);
            $unitclass = $this->unitClassDAO->getById($data['unitclass']);

            $perso = new Personnage();
            $perso->setId($data['id']);
            $perso->setName($data['name']);
            $perso->setElement($element);
            $perso->setOrigin($origin);
            $perso->setUnitclass($unitclass);
            $perso->setRarity($data['rarity']);
            $perso->setUrlImg($data['url_img']);

            $persos[] = $perso;
        }

        return $persos;
    }

    /**
     * Récupère la collection d'un utilisateur.
     *
     * @param string $userId ID unique de l'utilisateur.
     * @return array Liste des personnages possédés.
     */
    public function getCollectionByUser(string $userId): array
    {
        $dao = new \Models\PersonnageDAO();
        return $dao->getByUserId($userId);
    }
}
