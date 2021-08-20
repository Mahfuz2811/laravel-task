<?php

namespace App\DTO;

class ContentDto
{
    private $url;
    private $pocketId;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPocketId(): ?int
    {
        return $this->pocketId;
    }

    public function setPocketId(?int $pocketId): self
    {
        $this->pocketId = $pocketId;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'url' => $this->getUrl(),
            'pocket_id' => $this->getPocketId(),
        ];
    }

    public static function createFromArray(array $request, $pocketId): self
    {
        $obj = new self();

        $obj->setUrl($request['url']);
        $obj->setPocketId($pocketId);

        return $obj;
    }
}
