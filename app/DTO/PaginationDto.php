<?php

namespace App\DTO;

class PaginationDto
{
    private $page;
    private $perPage;

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPerPage(int $perPage, int $defaultPerPage): self
    {
        $this->perPage = $perPage > 1 ? $perPage : $defaultPerPage;

        return $this;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public static function createFromArray(array $request, int $defaultPerPage = 10): self
    {
        return (new self())
            ->setPage((int) ($request['page'] ?? 1))
            ->setPerPage((int) ($request['per_page'] ?? $defaultPerPage), $defaultPerPage);
    }
}
