<?php


namespace Models;

require_once 'BasePdoDAO.php';
require_once 'User.php';

class UserDAO extends BasePdoDAO
{
    public function getByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM USERS WHERE username = :username";
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute(['username' => $username]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null; // Aucun utilisateur trouvé
        }

        $user = new User();
        $user->hydrate($data);
        return $user;
    }

}
