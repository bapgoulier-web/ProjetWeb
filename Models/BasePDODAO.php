<?php

namespace Models;

use PDO;
use Config\Config;
use PDOStatement;

class BasePDODAO
{
    private static ?PDO $db = null;

    /**
     * Retourne l’instance PDO (singleton) et la crée si nécessaire.
     */
    protected static function getDB(): PDO
    {
        if (self::$db === null) {
            $dsn = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');
            self::$db = new PDO($dsn, $user, $pass);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$db;
    }

    /**
     * Exécute une requête SQL préparée et renvoie le PDOStatement.
     */
    protected function execRequest(string $sql, array $params = null): PDOStatement|false
    {
        $etat = self::getDB()->prepare($sql);
        $etat->execute($params);
        return $etat;
    }
}
