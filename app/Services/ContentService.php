<?php

namespace App\Services;

use App\DTO\ContentDto;
use App\DTO\PaginationDto;
use App\Events\ScrapingEvent;
use App\Repositories\ContentRepository;
use Throwable;

class ContentService
{
    private $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function getPocketContent(array $request, $pocketId)
    {
        $pagination = PaginationDto::createFromArray($request, 10);
        return $this->contentRepository->all($pagination, $pocketId);
    }

    public function store(array $request, $pocketId)
    {
        $contentData = ContentDto::createFromArray($request, $pocketId);

        $content = $this->contentRepository->store($contentData->toArray());

        event(new ScrapingEvent($content->url, $content->id));
    }

    public function delete($contentId): void
    {
        $this->contentRepository->delete($contentId);
    }

    // for view part
    public function getContents($limit = 10)
    {
        return $this->contentRepository->getContents($limit);
    }

    public function getContentsByPocket(int $pocketId, $limit = 10)
    {
        return $this->contentRepository->getContentsByPocket($pocketId, $limit);
    }
}
