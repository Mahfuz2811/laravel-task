<?php

namespace App\Repositories;

use App\Models\ScrapingData;

class ScrapingRepository
{
    public function store(array $data)
    {
        return ScrapingData::create($data);
    }
}
