<?php

namespace Controllers\Router;

use Exception;

/**
 * Classe abstraite Route
 * Sert de base à toutes les routes spécifiques
 */
abstract class Route
{
    protected string $action;
    protected string $method;
    protected $controller;

    public function __construct(string $action = "", $controller = null, string $method = "GET")
    {
        $this->action = $action;
        $this->controller = $controller;
        $this->method = $method;
    }


    /**
     * Fonction principale appelée par le routeur
     * Elle exécute la méthode get() ou post() selon le type de requête
     */
    public function action(array $params = [], string $method = "GET")
    {
        if ($method === "POST") {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    /**
     * Méthode utilitaire pour lire un paramètre GET ou POST
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Le paramètre '$paramName' est vide !");
            }
            return $array[$paramName];
        } else {
            throw new Exception("Le paramètre '$paramName' est manquant !");
        }
    }


    // Méthodes abstraites à implémenter dans les classes filles
    abstract public function get(array $params = []);

    abstract public function post(array $params = []);
}
