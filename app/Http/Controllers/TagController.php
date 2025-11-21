<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(20);
        return view('tags.index', compact('tags'));
    }

    public function show(int $tagId)
    {
        $tag = Tag::with('projects')->find($tagId);
        return view('tags.show', compact(['tag']));
    }
}
