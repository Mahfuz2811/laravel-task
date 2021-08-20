<?php

namespace App\Repositories;

use App\Models\Pocket;

class PocketRepository
{
    public function store(array $data): Pocket
    {
        return Pocket::create($data);
    }
}
