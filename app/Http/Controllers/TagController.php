<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }
}
