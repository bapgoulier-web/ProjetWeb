<?php

namespace Models;

/**
 * Classe représentant une origine de personnage.
 * Gère les propriétés id, nom et URL d’image.
 */
class Origin
{
    private ?int $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructeur de l’origine.
     */
    public function __construct(?int $id = null, string $name = '', string $urlImg = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    /**
     * Retourne l’identifiant de l’origine.
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Retourne le nom de l’origine.
     */
    public function getName(): string { return $this->name; }

    /**
     * Retourne l’URL de l’image de l’origine.
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Définit l’identifiant de l’origine.
     */
    public function setId(?int $id): void { $this->id = $id; }

    /**
     * Définit le nom de l’origine.
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l’URL de l’image de l’origine.
     */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    /**
     * Hydrate l’objet depuis un tableau associatif.
     * Utilise les setters correspondants s’ils existent.
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
