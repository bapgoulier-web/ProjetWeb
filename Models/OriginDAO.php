<?php

namespace Models;

require_once 'BasePdoDAO.php';
require_once 'Origin.php';

class OriginDAO extends BasePdoDAO
{
    /**
     * Récupère toutes les origines depuis la base de données.
     *
     * @return array Liste des objets Origin.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM ORIGIN";
        $stmt = $this->getDB()->query($sql);

        $origins = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $origin = new Origin();
            $origin->hydrate($row);
            $origins[] = $origin;
        }

        return $origins;
    }

    /**
     * Retourne une origine spécifique selon son identifiant.
     *
     * @param int $id Identifiant de l’origine.
     * @return Origin|null Objet Origin si trouvé, sinon null.
     */
    public function getById(int $id): ?Origin
    {
        $sql = "SELECT * FROM ORIGIN WHERE id = :id";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            $origin = new Origin();
            $origin->hydrate($data);
            return $origin;
        }

        return null;
    }
}
