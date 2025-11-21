<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    function index()
    {
        $projects = Project::with('author', 'tags', 'media')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    function show(int $projectId)
    {
        $project = Project::find($projectId);
        return view('projects.show', compact(['project']));
    }
}
