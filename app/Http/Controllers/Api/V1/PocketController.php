<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PocketRequest;
use App\Services\PocketService;
use Illuminate\Http\Request;

class PocketController extends ApiController
{
    private $pocketService;

    public function __construct(PocketService $pocketService)
    {
        $this->pocketService = $pocketService;
    }

    public function store(PocketRequest $request)
    {
        $response = $this->pocketService->store($request->toArray());
        if (!$response) {
            return $this->respondError(['error' => true, 'message' => 'Unable to create pocket']);
        }

        return $this->respondSuccess(['error' => false, 'message' => 'Pocket created successfully'], 201);
    }
}
