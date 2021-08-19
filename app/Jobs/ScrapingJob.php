<?php

namespace App\Jobs;

use App\Services\ScrapingService;

class ScrapingJob extends BaseJob
{
    private $url;
    private $contentId;

    public function __construct($url, $contentId, $tag = 'scraping-site')
    {
        $this->url = $url;
        $this->contentId = $contentId;
        $this->tries = 1;
        $this->tag = $tag;
    }

    public function handle(ScrapingService $scrapingService)
    {
        $this->logger(['attempt' => $this->attempts()]);

        $response = $scrapingService->scrapingData($this->url, $this->contentId);
        if (!$response) {
            $this->release(20);
            return;
        }

        $this->logger(['attempt' => $this->attempts(), 'deleting' => true]);
        $this->delete();
    }
}
