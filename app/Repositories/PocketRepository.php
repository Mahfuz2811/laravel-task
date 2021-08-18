<?php

namespace App\Repositories;

use App\Models\Pocket;

class PocketRepository
{
    public function store(array $data)
    {
        return Pocket::create($data);
    }
}
