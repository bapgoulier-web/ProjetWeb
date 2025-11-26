<?php

namespace Models;

require_once 'BasePdoDAO.php';
require_once 'Origin.php';

class OriginDAO extends BasePdoDAO
{
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
