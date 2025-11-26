<?php

namespace Controllers\Router\Route;
use Controllers\Router\Route;
use Exception;

abstract class ProtectedRoute extends Route implements IRouteSecurity
{
    protected bool $is_login_required = true;
    protected ?string $loggedUserId = null;

    public function __construct(string $action, $controller)
    {
        parent::__construct($action);
        $this->controller = $controller;
    }

    // Indique que cette route est protégée
    public function isRouteProtected(): bool
    {
        return true;
    }

    // Vérifie la session utilisateur
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

    public function getLoggedUserId(): ?string
    {
        return $this->loggedUserId;
    }

    public function setLoggedUserId(string $loggedUserId): void
    {
        $this->loggedUserId = $loggedUserId;
    }
}
