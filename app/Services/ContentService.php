<?php

namespace App\Services;

use App\Repositories\ContentRepository;
use Throwable;

class ContentService
{
    /**
     * @var ContentRepository
     */
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

    public function store(array $data)
    {
        try {
            $content = $this->contentRepository->store($data);
        } catch (Throwable $t) {
            return false;
        }

        if (!$content) {
            return false;
        }

        return $content;
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
