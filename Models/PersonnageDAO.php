<?php

namespace Models;

use PDO;

/**
 * DAO : Data Access Object
 * Permet d'interagir avec la table PERSONNAGE
 */
class PersonnageDAO extends BasePDODAO
{
    /**
     * Retourne tous les personnages sous forme d’un tableau d’objets Personnage
     * @return array<Personnage>
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM PERSONNAGE";
        $stmt = $this->execRequest($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $personnages = [];
        foreach ($rows as $row) {
            $personnages[] = new Personnage(
                $row['id'],
                $row['name'],
                $row['element'],
                $row['unitclass'],
                (int)$row['rarity'],
                $row['origin'] ?? null,
                $row['url_img']
            );
        }

        return $personnages;
    }

    /**
     * Retourne un personnage par son ID, ou null s’il n’existe pas
     * @param string $idPersonnage
     * @return ?Personnage
     */
    public function getByID(string $idPersonnage): ?Personnage
    {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = ?";
        $stmt = $this->execRequest($sql, [$idPersonnage]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Personnage(
                $row['id'],
                $row['name'],
                $row['element'],
                $row['unitclass'],
                (int)$row['rarity'],
                $row['origin'] ?? null,
                $row['url_img']
            );
        }

        return null;
    }
}
