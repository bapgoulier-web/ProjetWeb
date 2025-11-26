<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Exception;

/**
 * Classe représentant une route protégée, nécessitant une authentification
 * avant d'être accessible. Elle étend la classe Route et impose une vérification
 * de sécurité via l'interface IRouteSecurity.
 */
abstract class ProtectedRoute extends Route implements IRouteSecurity
{
    /**
     * Indique si l'accès nécessite une connexion utilisateur.
     */
    protected bool $is_login_required = true;

    /**
     * Contient l'ID de l'utilisateur connecté, une fois authentifié.
     */
    protected ?string $loggedUserId = null;

    /**
     * Initialise la route protégée en enregistrant l'action et le contrôleur.
     */
    public function __construct(string $action, $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    /**
     * Indique si la route est protégée et nécessite une authentification.
     */
    public function isRouteProtected(): bool
    {
        return true;
    }

    /**
     * Vérifie que l'utilisateur est bien connecté.
     * Lance une exception si l'accès est refusé.
     */
    public function protectRoute(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userUID']) || empty($_SESSION['userUID'])) {
            throw new Exception("⛔ Accès refusé : vous devez être connecté pour accéder à cette page.");
        }

        $this->loggedUserId = $_SESSION['userUID'];
    }

    /**
     * Retourne l'identifiant de l'utilisateur actuellement connecté.
     */
    public function getLoggedUserId(): ?string
    {
        return $this->loggedUserId;
    }

    /**
     * Définit manuellement l'identifiant de l'utilisateur connecté.
     */
    public function setLoggedUserId(string $loggedUserId): void
    {
        $this->loggedUserId = $loggedUserId;
    }
}
