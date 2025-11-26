<?php

namespace Models;

class User
{
    private string $id;
    private string $username;
    private string $hash_pwd;

    /**
     * Retourne l'identifiant unique de l'utilisateur.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Retourne le nom d'utilisateur.
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Retourne le mot de passe hashé.
     */
    public function getHashPwd(): string
    {
        return $this->hash_pwd;
    }

    /**
     * Définit l'identifiant unique de l'utilisateur.
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Définit le nom d'utilisateur.
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Définit le mot de passe hashé.
     */
    public function setHashPwd(string $hash_pwd): void
    {
        $this->hash_pwd = $hash_pwd;
    }

    /**
     * Hydrate l'objet User à partir d'un tableau associatif.
     * Convertit automatiquement les clés snake_case vers les setters correspondants.
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucfirst($key));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
