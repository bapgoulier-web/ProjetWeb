<?php

namespace Models;

require_once 'BasePdoDAO.php';
require_once 'User.php';

class UserDAO extends BasePdoDAO
{
    /**
     * Récupère un utilisateur à partir de son nom d’utilisateur.
     * Retourne un objet User si trouvé, sinon null.
     */
    public function getByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM USERS WHERE username = :username";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['username' => $username]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new User();
        $user->hydrate($data);
        return $user;
    }
}
