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

    public function store(array $request): bool
    {
        $pocket = PocketDto::createFromArray($request);

        $this->pocketRepository->store($pocket->toArray());

        return true;
    }
}
