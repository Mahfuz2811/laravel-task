<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ScrapingEvent;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ContentRequest;
use App\Models\Content;
use App\Models\Pocket;
use App\Services\ContentService;

class ContentController extends ApiController
{
    /**
     * @var ContentService
     */
    private $contentService;

    public function __construct(ContentService $contentService)
    {

        $this->contentService = $contentService;
    }

    public function index($pocketId)
    {
        $response = $this->contentService->getPocketContent($pocketId);
        if (!$response) {
            return $this->respondError(['error' => true, 'message' => 'Unable to fetch content']);
        }

        return $this->respondSuccess(['error' => false, 'data' => $response]);
    }

    public function store(ContentRequest $request, $pocketId)
    {
        $pocket = Pocket::find($pocketId);
        if (!$pocket) {
            return $this->respondError(['error' => true, 'message' => 'Pocket not found'], 404);
        }

        $response = $this->contentService->store($request->toArray(), $pocketId);
        if (!$response) {
            return $this->respondError(['error' => true, 'message' => 'Unable to create content']);
        }

        $contentId = $response->id;
        event(new ScrapingEvent($request->get('url'), $contentId));

        return $this->respondSuccess(['error' => false, 'message' => 'Content created successfully'], 201);
    }

    public function destroy($contentId)
    {
        $content = Content::find($contentId);
        if (!$content) {
            return $this->respondError(['error' => true, 'message' => 'Content not found'], 404);
        }

        $response = $this->contentService->delete($contentId);
        if (!$response) {
            return $this->respondError(['error' => true, 'message' => 'Unable to delete content']);
        }

        return $this->respondSuccess(['error' => false, 'message' => 'Content deleted successfully'], 202);
    }
}
