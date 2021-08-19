<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ScrapingEvent;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\ContentRequest;
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
        $data = $request->only('url');
        $data['pocket_id'] = $pocketId;

        $response = $this->contentService->store($data);
        if (!$response) {
            return $this->respondError(['error' => true, 'message' => 'Unable to create content']);
        }

        event(new ScrapingEvent($request->get('url')));

        return $this->respondSuccess(['error' => false, 'message' => 'Content created successfully']);
    }

    public function destroy($contentId)
    {
        $response = $this->contentService->delete($contentId);
        if (!$response) {
            return $this->respondError(['error' => true, 'message' => 'Unable to delete content']);
        }

        return $this->respondSuccess(['error' => false, 'message' => 'Content deleted successfully']);
    }
}
