<?php

namespace Models;

class Personnage
{
    private ?string $id;
    private string $name;
    private ?Element $element;
    private ?UnitClass $unitclass;
    private ?Origin $origin;
    private int $rarity;
    private string $urlImg;

    /**
     * Constructeur du personnage.
     * Initialise toutes les propriétés principales du personnage.
     */
    public function __construct(
        ?string $id = null,
        string $name = '',
        ?Element $element = null,
        ?UnitClass $unitclass = null,
        ?Origin $origin = null,
        int $rarity = 1,
        string $urlImg = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->element = $element;
        $this->unitclass = $unitclass;
        $this->origin = $origin;
        $this->rarity = $rarity;
        $this->urlImg = $urlImg;
    }

    // Getters

    /**
     * Retourne l'identifiant du personnage.
     */
    public function getId(): ?string { return $this->id; }

    /**
     * Retourne le nom du personnage.
     */
    public function getName(): string { return $this->name; }

    /**
     * Retourne l’élément du personnage.
     */
    public function getElement(): ?Element { return $this->element; }

    /**
     * Retourne la classe du personnage.
     */
    public function getUnitclass(): ?UnitClass { return $this->unitclass; }

    /**
     * Retourne l’origine du personnage.
     */
    public function getOrigin(): ?Origin { return $this->origin; }

    /**
     * Retourne la rareté du personnage.
     */
    public function getRarity(): int { return $this->rarity; }

    /**
     * Retourne l’URL de l’image du personnage.
     */
    public function getUrlImg(): string { return $this->urlImg; }

    // Setters

    /**
     * Définit l’identifiant du personnage.
     */
    public function setId(?string $id): void { $this->id = $id; }

    /**
     * Définit le nom du personnage.
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l’élément du personnage.
     */
    public function setElement(?Element $element): void { $this->element = $element; }

    /**
     * Définit la classe d’unité du personnage.
     */
    public function setUnitclass(?UnitClass $unitclass): void { $this->unitclass = $unitclass; }

    /**
     * Définit l’origine du personnage.
     */
    public function setOrigin(?Origin $origin): void { $this->origin = $origin; }

    /**
     * Définit la rareté du personnage.
     */
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    /**
     * Définit l’URL de l’image du personnage.
     */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    // Hydrate

    /**
     * Hydrate automatiquement l’objet depuis un tableau associatif.
     * Convertit les clés snake_case en camelCase et ignore les relations.
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $key = str_replace('_', '', ucwords($key, '_'));

            if (in_array(strtolower($key), ['element', 'unitclass', 'origin'])) {
                continue;
            }

            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
