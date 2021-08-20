<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Paginator;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ContentRequest;
use App\Http\Resources\ContentResource;
use App\Services\ContentService;
use Illuminate\Http\Request;

class ContentController extends ApiController
{
    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index(Request $request, $pocketId)
    {
        $response = $this->contentService->getPocketContent($request->toArray(), $pocketId);

        return $this->respondSuccess([
            'error' => false,
            'data' => [
                'content' => ContentResource::collection($response),
                'pagination' => Paginator::simplePaginationDetails($response)
            ]
        ]);
    }

    public function store(ContentRequest $request, $pocketId)
    {
        $this->contentService->store($request->toArray(), $pocketId);

        return $this->respondSuccess(['error' => false, 'message' => 'Content created successfully'], 201);
    }

    public function destroy($contentId)
    {
        $this->contentService->delete($contentId);

        return $this->respondSuccess(['error' => false, 'message' => 'Content deleted successfully']);
    }
}
