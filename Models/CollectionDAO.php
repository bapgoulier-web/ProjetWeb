<?php

namespace Models;

use PDO;

class CollectionDAO extends BasePDODAO
{
    public function addToCollection(int $userId, string $persoId): bool
    {
        $sql = "INSERT INTO collection (id_user, id_perso) VALUES (:id_user, :id_perso)";
        $stmt = self::getDB()->prepare($sql);
        return $stmt->execute(['id_user' => $userId, 'id_perso' => $persoId]);
    }

    public function removeFromCollection(int $userId, string $persoId): bool
    {
        $sql = "DELETE FROM collection WHERE id_user = :id_user AND id_perso = :id_perso";
        $stmt = self::getDB()->prepare($sql);
        return $stmt->execute(['id_user' => $userId, 'id_perso' => $persoId]);
    }

    public function getUserCollection(int $userId): array
    {
        $sql = "SELECT id_perso FROM collection WHERE id_user = :id_user";
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute(['id_user' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
