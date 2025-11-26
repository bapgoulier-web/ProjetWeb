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

    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
        $this->originDAO = new OriginDAO();
        $this->elementDAO = new ElementDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }

    public function getAllPerso(): array
    {
        $persosData = $this->personnageDAO->getAll(); // récupère toutes les lignes brutes
        $persos = [];

        foreach ($persosData as $data) {
            // Récupération des objets associés
            $element = $this->elementDAO->getById($data['element']);
            $origin = $this->originDAO->getById($data['origin']);
            $unitclass = $this->unitClassDAO->getById($data['unitclass']);

            // Création du personnage complet
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

    public function getCollectionByUser(string $userId): array
    {
        $dao = new \Models\PersonnageDAO();
        return $dao->getByUserId($userId);
    }

}
