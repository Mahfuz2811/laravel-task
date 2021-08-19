<?php

namespace App\Events;

class ScrapingEvent extends Event
{
    public $url;
    public $contentId;

    public function __construct($url, $contentId)
    {
        $this->url = $url;
        $this->contentId = $contentId;
    }
}
