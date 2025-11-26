<?php
namespace Config;
use Exception;

class Config {
    private static $param;

    /**
     * Renvoie la valeur d'un paramètre de configuration s’il existe,
     * sinon retourne une valeur par défaut.
     */
    public static function get($nom, $valeurParDefaut = null) {
        if (isset(self::getParameter()[$nom])) {
            $valeur = self::getParameter()[$nom];
        }
        else {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

    /**
     * Charge (si nécessaire) et retourne le tableau des paramètres
     * contenus dans le fichier de configuration prod.ini ou dev.ini.
     *
     * @throws Exception Si aucun fichier de configuration n’est trouvé.
     */
    private static function getParameter() {
        if (self::$param == null) {
            $cheminFichier = "Config/prod.ini";

            if (!file_exists($cheminFichier)) {
                $cheminFichier = "Config/dev.ini";
            }

            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }
            else {
                self::$param = parse_ini_file($cheminFichier);
            }
        }
        return self::$param;
    }
}
