<?php


namespace Models;

class User
{
    private string $id;
    private string $username;
    private string $hash_pwd;

    /* ----------- Getters ----------- */
    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getHashPwd(): string
    {
        return $this->hash_pwd;
    }

    /* ----------- Setters ----------- */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setHashPwd(string $hash_pwd): void
    {
        $this->hash_pwd = $hash_pwd;
    }

    /* ----------- Hydratation ----------- */
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
