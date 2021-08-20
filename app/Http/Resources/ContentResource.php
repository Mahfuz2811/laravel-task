<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'title' => $this->scrapingData->title ?? '',
            'content' => $this->scrapingData->content ?? '',
            'image_url' => $this->scrapingData->image_url ?? '',
            'pocket' => $this->pocket->title,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
