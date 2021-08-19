<?php

namespace App\Services;

use App\Models\ScrapingData;
use App\Repositories\ScrapingRepository;
use Goutte\Client;
use Throwable;

class ScrapingService
{
    private $scrapingRepository;

    public function __construct(ScrapingRepository $scrapingRepository)
    {

        $this->scrapingRepository = $scrapingRepository;
    }

    public function scrapingData($url, $contentId): bool
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $title = '';
        $titleObj = $crawler->filter('h1');
        if ($titleObj->count() > 0) {
            $title = $titleObj->text();
        }

        if (!$title) {
            $titleObj = $crawler->filter('h2');
            if ($titleObj->count() > 0) {
                $title = $titleObj->text();
            }
        }

        // taking all images
        $images = $crawler->filter('img')->each(function ($node) {
            return $node->attr('src');
        });
        $image = $images[0] ?? ''; // consider first image is heading image

        $para = $crawler->filter('p')->each(function ($node) {
            return $node->text();
        });

        $content = implode(",", $para);
        $data = [
            'url' => $url,
            'title' => $title,
            'content' => $content,
            'image_url' => $image,
            'content_id' => $contentId
        ];

        try {
            $scraping = $this->scrapingRepository->store($data);
        } catch (Throwable $t) {
            return false;
        }

        if (!$scraping) {
            return false;
        }

        return true;

    }
}
