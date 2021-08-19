<?php

namespace App\Events;

class ScrapingEvent extends Event
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }
}
