<?php

namespace App\Repositories;

use App\DTO\PaginationDto;
use App\Models\Content;

class ContentRepository
{
    public function all(PaginationDto $pagination, int $pocketId)
    {
        return Content::with(['pocket', 'scrapingData'])->where('pocket_id', $pocketId)->paginate($pagination->getPerPage(), ['*'], 'page', $pagination->getPage());
    }

    public function store(array $data): Content
    {
        return Content::create($data);
    }

    public function delete(int $contentId): void
    {
        $content = Content::findOrFail($contentId);
        $content->delete();
    }

    // for view part
    public function getContents(int $limit)
    {
        return Content::with('pocket', 'scrapingData')
            ->orderBy('pocket_id', 'asc')
            ->paginate($limit)
            ->appends(request()->query());
    }

    public function getContentsByPocket(int $pocketId, int $limit)
    {
        return Content::with('pocket', 'scrapingData')
            ->where('pocket_id', $pocketId)
            ->orderBy('pocket_id', 'asc')
            ->paginate($limit)
            ->appends(request()->query());
    }
}
