<?php

namespace Models;

require_once 'BasePdoDAO.php';
require_once 'Element.php';

class ElementDAO extends BasePdoDAO
{
    /**
     * Récupère tous les éléments depuis la base de données
     * et renvoie un tableau d’objets Element hydratés.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM ELEMENT";
        $stmt = $this->getDB()->query($sql);

        $elements = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $element = new Element();
            $element->hydrate($row);
            $elements[] = $element;
        }

        return $elements;
    }

    /**
     * Récupère un élément par son identifiant.
     * Retourne un objet Element si trouvé, sinon null.
     */
    public function getById(int $id): ?Element
    {
        $sql = "SELECT * FROM ELEMENT WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            $element = new Element();
            $element->hydrate($data);
            return $element;
        }

        return null;
    }
}
