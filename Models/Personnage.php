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

    /* ---------- Getters ---------- */
    public function getId(): ?string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getElement(): ?Element { return $this->element; }
    public function getUnitclass(): ?UnitClass { return $this->unitclass; }
    public function getOrigin(): ?Origin { return $this->origin; }
    public function getRarity(): int { return $this->rarity; }
    public function getUrlImg(): string { return $this->urlImg; }

    /* ---------- Setters ---------- */
    public function setId(?string $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setElement(?Element $element): void { $this->element = $element; }
    public function setUnitclass(?UnitClass $unitclass): void { $this->unitclass = $unitclass; }
    public function setOrigin(?Origin $origin): void { $this->origin = $origin; }
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    /* ---------- Hydrate ---------- */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            // 🧩 Conversion du snake_case en camelCase (url_img -> urlImg)
            $key = str_replace('_', '', ucwords($key, '_'));

            // On ignore les relations (elles sont gérées dans le DAO)
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
