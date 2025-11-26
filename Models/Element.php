<?php

namespace Models;

/**
 * Représente un élément (ex : Pyro, Hydro, etc.).
 * Contient son identifiant, son nom et l’URL de son image.
 */
class Element
{
    private ?int $id;
    private string $name;
    private string $urlImg;

    /**
     * Initialise un objet Element avec ses propriétés.
     */
    public function __construct(?int $id = null, string $name = '', string $urlImg = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    /** Retourne l’ID de l’élément. */
    public function getId(): ?int { return $this->id; }

    /** Retourne le nom de l’élément. */
    public function getName(): string { return $this->name; }

    /** Retourne l’URL de l’image associée. */
    public function getUrlImg(): string { return $this->urlImg; }

    /** Définit l’ID de l’élément. */
    public function setId(?int $id): void { $this->id = $id; }

    /** Définit le nom de l’élément. */
    public function setName(string $name): void { $this->name = $name; }

    /** Définit l’URL de l’image de l’élément. */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    /**
     * Hydrate automatiquement l’objet à partir d’un tableau associatif.
     * Chaque clé du tableau doit correspondre à un setter existant.
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
