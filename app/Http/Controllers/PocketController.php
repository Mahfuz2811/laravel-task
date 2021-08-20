<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Pocket;

class PocketController extends Controller
{
    public function index()
    {
        $pocketId = '';
        $pockets = Pocket::all();
        $contents = Content::with('pocket', 'scrapingData')
            ->orderBy('pocket_id', 'asc')
            ->paginate(10)
            ->appends(request()->query());
        return view('pocket', compact('contents', 'pockets', 'pocketId'));
    }

    public function show($pocketId)
    {
        $pockets = Pocket::all();
        $contents = Content::with('pocket', 'scrapingData')
            ->where('pocket_id', $pocketId)
            ->orderBy('pocket_id', 'asc')
            ->paginate(10)
            ->appends(request()->query());
        return view('pocket', compact('contents', 'pockets', 'pocketId'));
    }
}
