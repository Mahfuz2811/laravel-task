<?php

namespace App\Services;

use App\DTO\PocketDto;
use App\Repositories\PocketRepository;

class PocketService
{
    private $pocketRepository;

    public function __construct(PocketRepository $pocketRepository)
    {
        $this->pocketRepository = $pocketRepository;
    }

    public function store(array $request): void
    {
        $pocket = PocketDto::createFromArray($request);

        $this->pocketRepository->store($pocket->toArray());
    }

    // for view part
    public function getPockets()
    {
        return $this->pocketRepository->getPockets();
    }
}
