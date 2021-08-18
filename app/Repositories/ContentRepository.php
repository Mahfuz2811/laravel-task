<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository
{
    public function all(int $pocketId)
    {
        return Content::where('pocket_id', $pocketId)->get();
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
