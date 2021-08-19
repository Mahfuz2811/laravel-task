<?php

namespace App\Listeners;

use App\Events\ScrapingEvent;
use App\Jobs\ScrapingJob;

class ScrapingEventListener
{
    public function handle(ScrapingEvent $event)
    {
        dispatch(new ScrapingJob($event->url));
    }
}
