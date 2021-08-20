<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PocketRequest;
use App\Services\PocketService;

class PocketController extends ApiController
{
    private $pocketService;

    public function __construct(PocketService $pocketService)
    {
        $this->pocketService = $pocketService;
    }

    public function store(PocketRequest $request)
    {
        $this->pocketService->store($request->toArray());

        return $this->respondSuccess(['error' => false, 'message' => 'Pocket created successfully'], 201);
    }
}
