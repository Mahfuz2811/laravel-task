<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository
{
    public function all(int $pocketId, $perPage = 10)
    {
        return Content::where('pocket_id', $pocketId)->paginate($perPage);
    }

    public function store(array $data)
    {
        return Content::create($data);
    }

    public function delete(int $contentId)
    {
        $content = Content::find($contentId);
        if ($content) {
            return $content->delete();
        }

        return false;
    }
}
