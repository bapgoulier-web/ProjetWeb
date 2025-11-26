<?php

namespace Models;

use PDO;

class CollectionDAO extends BasePdoDAO
{
    /**
     * Retourne tous les ID de personnages dans la collection d’un utilisateur.
     */
    public function getUserCollection(int $userId): array
    {
        $sql = "SELECT id_perso FROM COLLECTION WHERE id_user = :uid";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['uid' => $userId]);

        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_perso');
    }

    /**
     * Ajoute un personnage à la collection.
     */
    public function addToCollection(int $userId, string $persoId): bool
    {
        $sql = "INSERT INTO COLLECTION (id_user, id_perso)
                VALUES (:uid, :pid)";
        $stmt = $this->getDB()->prepare($sql);
        return $stmt->execute([
            'uid' => $userId,
            'pid' => $persoId
        ]);
    }

    /**
     * Retire un personnage d’une collection.
     */
    public function removeFromCollection(int $userId, string $persoId): bool
    {
        $sql = "DELETE FROM COLLECTION
                WHERE id_user = :uid AND id_perso = :pid";

        $stmt = $this->getDB()->prepare($sql);
        return $stmt->execute([
            'uid' => $userId,
            'pid' => $persoId
        ]);
    }
}
