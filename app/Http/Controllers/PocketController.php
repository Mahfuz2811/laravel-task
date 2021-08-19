<?php

namespace App\Http\Controllers;

use App\Models\Content;

class PocketController extends Controller
{
    public function index()
    {
        $contents = Content::with('pocket')->paginate(10);
        return view('pocket', compact('contents'));
    }
}
