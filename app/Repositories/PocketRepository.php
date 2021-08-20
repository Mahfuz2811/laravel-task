<?php

namespace App\Repositories;

use App\Models\Pocket;

class PocketRepository
{
    public function store(array $data): void
    {
        Pocket::create($data);
    }

    // for view part
    public function getPockets()
    {
        return Pocket::all();
    }
}
