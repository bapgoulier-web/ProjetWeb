<?php

namespace Models;
use PDO;

class PersonnageDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM PERSONNAGE";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById(string $id): ?Personnage
    {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $personnage = new Personnage();
        $personnage->hydrate($data);

        // 🔗 On récupère les objets liés (Element, UnitClass, Origin)
        $elementDao = new \Models\ElementDAO();
        $unitclassDao = new \Models\UnitClassDAO();
        $originDao = new \Models\OriginDAO();

        // ⚡ On transforme les ID en objets complets
        $element = $elementDao->getById((int)$data['element']);
        $unitclass = $unitclassDao->getById((int)$data['unitclass']);
        $origin = !empty($data['origin']) ? $originDao->getById((int)$data['origin']) : null;

        $personnage->setElement($element);
        $personnage->setUnitclass($unitclass);
        $personnage->setOrigin($origin);

        return $personnage;
    }

    public function createPersonnage(Personnage $perso): bool
    {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img)
            VALUES (:id, :name, :element, :unitclass, :origin, :rarity, :url_img)";
        $stmt = $this->getDB()->prepare($sql);
        return $stmt->execute([
            'id'        => $perso->getId(),
            'name'      => $perso->getName(),
            'element'   => $perso->getElement()?->getId(),
            'unitclass' => $perso->getUnitclass()?->getId(),
            'origin'    => $perso->getOrigin()?->getId(),
            'rarity'    => $perso->getRarity(),
            'url_img'   => $perso->getUrlImg(),
        ]);
    }

    public function updatePerso(Personnage $perso): bool
    {
        $sql = "UPDATE PERSONNAGE 
            SET name = :name, 
                element = :element, 
                unitclass = :unitclass, 
                origin = :origin, 
                rarity = :rarity, 
                url_img = :url_img
            WHERE id = :id";

        $stmt = $this->getDB()->prepare($sql);
        return $stmt->execute([
            'id'        => $perso->getId(),
            'name'      => $perso->getName(),
            'element'   => $perso->getElement()?->getId(),
            'unitclass' => $perso->getUnitclass()?->getId(),
            'origin'    => $perso->getOrigin()?->getId(),
            'rarity'    => $perso->getRarity(),
            'url_img'   => $perso->getUrlImg(),
        ]);
    }

    public function deletePerso(string $id): bool
    {
        $sql = "DELETE FROM PERSONNAGE WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getByIds(array $ids): array
    {
        if (empty($ids)) return [];

        $in = str_repeat('?,', count($ids) - 1) . '?';
        $sql = "SELECT * FROM personnage WHERE id IN ($in)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute($ids);

        $list = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $list[] = $this->createObject($row);
        }
        return $list;
    }


    private function createObject(array $row): \Models\Personnage
    {
        $personnage = new \Models\Personnage();
        $personnage->setId($row['id']);
        $personnage->setName($row['name']);
        $personnage->setRarity($row['rarity']);
        $personnage->setUrlImg($row['url_img'] ?? null);

        if (isset($row['id_element'])) {
            $elementDAO = new \Models\ElementDAO();
            $personnage->setElement($elementDAO->getById($row['id_element']));
        }

        if (isset($row['id_unitclass'])) {
            $unitDAO = new \Models\UnitclassDAO();
            $personnage->setUnitclass($unitDAO->getById($row['id_unitclass']));
        }

        if (isset($row['id_origin'])) {
            $originDAO = new \Models\OriginDAO();
            $personnage->setOrigin($originDAO->getById($row['id_origin']));
        }

        return $personnage;
    }



}
