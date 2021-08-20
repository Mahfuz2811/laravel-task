<?php

namespace App\Services;

use App\DTO\ContentDto;
use App\Repositories\ContentRepository;
use Throwable;

class ContentService
{
    private $contentRepository;

    public function __construct(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    public function getPocketContent($pocketId)
    {
        try {
            $data = $this->contentRepository->all($pocketId);
        } catch (Throwable $t) {
            return false;
        }

        return $data;
    }

    public function store(array $request, $pocketId)
    {
        $contentData = ContentDto::createFromArray($request, $pocketId);

        return $this->contentRepository->store($contentData->toArray());
    }

    public function delete($contentId): bool
    {
        try {
            $content = $this->contentRepository->delete($contentId);
        } catch (Throwable $t) {
            return false;
        }

        if (!$content) {
            return false;
        }

        return true;
    }
}
