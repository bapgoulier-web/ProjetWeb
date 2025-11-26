<?php

namespace Models;

require_once 'BasePdoDAO.php';
require_once 'UnitClass.php';

class UnitClassDAO extends BasePdoDAO
{
    /**
     * Récupère toutes les classes d’unité
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM UNITCLASS";
        $stmt = $this->getDB()->query($sql);

        $unitClasses = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $unitClass = new UnitClass();
            $unitClass->hydrate($row);
            $unitClasses[] = $unitClass;
        }

        return $unitClasses;
    }

    /**
     * Récupère une classe d’unité par son ID
     */
    public function getById(int $id): ?UnitClass
    {
        $sql = "SELECT * FROM UNITCLASS WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            $unitClass = new UnitClass();
            $unitClass->hydrate($data);
            return $unitClass;
        }

        return null;
    }
}
