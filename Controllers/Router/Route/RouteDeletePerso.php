<?php

namespace Controllers\Router\Route;

use Controllers\PersoController;
use Controllers\Router\Route;
use Exception;

class RouteDeletePerso extends Route
{
    protected $controller;

    /**
     * Initialise la route permettant la suppression d’un personnage.
     *
     * @param string $action Nom de l’action associée à la route.
     * @param PersoController $controller Contrôleur gérant les personnages.
     */
    public function __construct(string $action, PersoController $controller)
    {
        parent::__construct($action, $controller);
        $this->controller = $controller;
    }

    /**
     * Traite la suppression d’un personnage via une requête GET.
     * Récupère l'identifiant du personnage et appelle le contrôleur pour le supprimer.
     * En cas d'erreur (ID manquant ou invalide), déclenche la suppression avec gestion d'erreur.
     *
     * @param array $params Paramètres passés à la route.
     */
    public function get(array $params = []): void
    {
        try {
            $idPerso = parent::getParam($params, "idPerso", false);
            $this->controller->deletePersoAndIndex($idPerso);
        } catch (\Exception $e) {
            $this->controller->deletePersoAndIndex();
        }
    }

    /**
     * Méthode POST inutilisée pour cette action.
     *
     * @param array $params Paramètres éventuels passés à la route.
     */
    public function post(array $params = []): void{}
}
