<?php

namespace App\DTO;

class PocketDto
{
    private $title;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
        ];
    }

    public static function createFromArray(array $request): self
    {
        $obj = new self();

        $obj->setTitle($request['title']);

        return $obj;
    }
}
