<?php

namespace App\Services;

use App\Models\ScrapingData;
use Goutte\Client;
use Throwable;

class ScrapingService
{
    public function scrapingData($url): bool
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

        try {
            $scraping = ScrapingData::create([
                'url' => $url,
                'title' => $title,
                'content' => $content,
                'image_url' => $image
            ]);

            return true;
        } catch (Throwable $t) {
            return false;
        }

    }
}
