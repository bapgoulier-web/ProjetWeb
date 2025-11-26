<?php

namespace Models;

class UnitClass
{
    private ?int $id;
    private string $name;
    private string $urlImg;

    public function __construct(?int $id = null, string $name = '', string $urlImg = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUrlImg(): string { return $this->urlImg; }

    public function setId(?int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

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
