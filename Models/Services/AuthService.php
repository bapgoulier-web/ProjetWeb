<?php

namespace Models\Services;

use Models\UserDAO;

class AuthService
{
    /**
     * Tente de connecter un utilisateur.
     * Vérifie les identifiants, démarre la session et enregistre les informations utilisateur.
     *
     * @return bool Retourne true si la connexion réussit, sinon false.
     */
    public static function login(string $username, string $password): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $dao = new UserDAO();
        $user = $dao->getByUsername($username);

        if ($user && password_verify($password, $user->getHashPwd())) {
            $_SESSION['userUID'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['login_time'] = time();
            $_SESSION['timeout'] = 3600;

            return true;
        }

        return false;
    }

    /**
     * Vérifie si un utilisateur est authentifié.
     * Contrôle le timeout et déconnecte automatiquement si expiré.
     */
    public static function isAuthenticated(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['userUID']) && isset($_SESSION['login_time'])) {
            if ((time() - $_SESSION['login_time']) < $_SESSION['timeout']) {
                return true;
            } else {
                self::logout();
            }
        }

        return false;
    }

    /**
     * Déconnecte proprement l’utilisateur.
     * Vide et détruit la session active.
     */
    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }
}
