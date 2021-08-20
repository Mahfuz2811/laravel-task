<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Pocket;
use App\Services\ContentService;
use App\Services\PocketService;

class PocketController extends Controller
{
    private $pocketService;
    private $contentService;

    public function __construct(PocketService $pocketService, ContentService $contentService)
    {
        $this->pocketService = $pocketService;
        $this->contentService = $contentService;
    }

    public function index()
    {
        $pocketId = '';
        $pockets = $this->pocketService->getPockets();
        $contents = $this->contentService->getContents(10);

        return view('pages.pocket.index', compact('contents', 'pockets', 'pocketId'));
    }

    public function show($pocketId)
    {
        $pockets = $this->pocketService->getPockets();
        $contents = $this->contentService->getContentsByPocket($pocketId);

        return view('pages.pocket.index', compact('contents', 'pockets', 'pocketId'));
    }
}
