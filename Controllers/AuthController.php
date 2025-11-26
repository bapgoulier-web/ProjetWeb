<?php


namespace Controllers;

use Models\UserDAO;

class AuthController
{
    private \League\Plates\Engine $templates;

    public function __construct()
    {
        $this->templates = new \League\Plates\Engine('Views');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    }

    // 🔹 Affiche le formulaire de login
    public function displayLogin(?string $message = null): void
    {
        echo $this->templates->render('login', ['message' => $message]);
    }

    // 🔹 Vérifie les identifiants
    public function login(array $params): void
    {
        $username = $params['username'] ?? '';
        $password = $params['password'] ?? '';

        if (\Models\Services\AuthService::login($username, $password)) {
            header("Location: index.php?action=protected");
            exit;
        } else {
            $this->displayLogin("❌ Identifiants incorrects");
        }
    }


    // 🔹 Page protégée
    public function displayProtected(): void
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }

        echo $this->templates->render('protected');
    }

    // 🔹 Déconnexion
    public function logout(): void
    {
        \Models\Services\AuthService::logout();
        header("Location: index.php?action=login");
        exit;
    }
}
