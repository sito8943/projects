<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {

        $users = User::all();
        return view('admin.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'author_id' => ['required', 'integer'],
            "header_image" => ['nullable', 'image'],
            "leading" => ['nullable', 'string'],
            'content' => ['nullable', 'string']
        ]);

        $path = '';

        if (
            $request->hasFile('header_image')
        ) {
            $path = $request->file('header_image')->store('projects', 'public');
            unset($validated['header_image']);
        }

        Project::create($validated + ['header_image_path' => $path]);

        return redirect('/admin/projects');
    }

    public function edit(int $id)
    {
        $project = Project::find($id);
        $users = User::all();
        return view('admin.projects.edit', compact(['project', 'users']));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'author_id' => ['required', 'integer'],
            "header_image" => ['nullable', 'image'],
            "leading" => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            "is_published" => ['nullable', 'boolean'],
            "published_at" => ['nullable']
        ]);

        if (
            $request->hasFile('header_image')
        ) {
            $path = $request->file('header_image')->store('projects', 'public');
            unset($validated['header_image']);
        }

        $project = Project::find($id);
        $project->update($validated + ['header_image_path' => $path]);

        return redirect('/admin/projects');
    }

    public function destroy(int $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect('/admin/projects');
    }
}

