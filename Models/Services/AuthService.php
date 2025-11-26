<?php

namespace Models\Services;

use Models\UserDAO;

class AuthService
{
    /**
     * 🔐 Tente de connecter un utilisateur
     * @param string $username
     * @param string $password
     * @return bool True si la connexion réussit, sinon False
     */
    public static function login(string $username, string $password): bool
    {
        // ✅ Démarre la session uniquement si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1️⃣ Récupération du user
        $dao = new UserDAO();
        $user = $dao->getByUsername($username);

        // 2️⃣ Vérification du mot de passe
        if ($user && password_verify($password, $user->getHashPwd())) {

            // 3️⃣ Création des variables de session
            $_SESSION['userUID'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['login_time'] = time();
            $_SESSION['timeout'] = 3600; // ⏱ durée de session (1h ici)

            return true;
        }

        // ❌ Identifiants invalides
        return false;
    }

    /**
     * Vérifie si un utilisateur est connecté
     */
    public static function isAuthenticated(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['userUID']) && isset($_SESSION['login_time'])) {
            // Vérifie le timeout
            if ((time() - $_SESSION['login_time']) < $_SESSION['timeout']) {
                return true;
            } else {
                // Déconnexion automatique si timeout dépassé
                self::logout();
            }
        }

        return false;
    }

    /**
     * Déconnecte proprement l’utilisateur
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
