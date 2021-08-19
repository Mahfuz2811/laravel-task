<?php

namespace App\Services;

use App\Repositories\PocketRepository;
use Throwable;

class PocketService
{
    private $pocketRepository;

    public function __construct(PocketRepository $pocketRepository)
    {
        $this->pocketRepository = $pocketRepository;
    }

    /**
     * @throws Throwable
     */
    public function store(array $data): bool
    {
        try {
            $pocket = $this->pocketRepository->store($data);
        } catch (Throwable $t) {
            return false;
        }

        if (!$pocket) {
            return false;
        }

        return true;
    }
}
