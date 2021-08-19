<?php

namespace App\Jobs;

use App\Services\ScrapingService;

class ScrapingJob extends BaseJob
{
    private $url;

    public function __construct($url, $tag = 'scraping-site')
    {
        $this->url = $url;
        $this->tries = 1;
        $this->tag = $tag;
    }

    public function handle(ScrapingService $scrapingService)
    {
        $this->logger(['attempt' => $this->attempts()]);

        $response = $scrapingService->scrapingData($this->url);
        if (!$response) {
            $this->release(20);
            return;
        }

        $this->logger(['attempt' => $this->attempts(), 'deleting' => true]);
        $this->delete();
    }
}
