<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'color' => []
        ]);

        Tag::create($validated);

        return redirect('/admin/tags');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact(['tag']));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'color' => []
        ]);

        $tag = Tag::find($id);

        $tag->update($validated);

        return redirect('/admin/tags');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect('/admin/tags');
    }
}
