<?php

namespace Models;

/**
 * Représente une classe d’unité (ex : Archer, Mage…).
 * Contient son identifiant, son nom et l’URL de son image.
 */
class UnitClass
{
    private ?int $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructeur de la classe UnitClass.
     * Initialise l’objet avec un id, un nom et une URL d’image.
     */
    public function __construct(?int $id = null, string $name = '', string $urlImg = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    /**
     * Retourne l’identifiant de la classe d’unité.
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Retourne le nom de la classe d’unité.
     */
    public function getName(): string { return $this->name; }

    /**
     * Retourne l’URL de l’image de la classe d’unité.
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Définit l’identifiant de la classe d’unité.
     */
    public function setId(?int $id): void { $this->id = $id; }

    /**
     * Définit le nom de la classe d’unité.
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l’URL de l’image de la classe d’unité.
     */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    /**
     * Hydrate l'objet à partir d'un tableau associatif.
     * Associe chaque clé du tableau à son setter correspondant.
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
