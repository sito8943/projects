<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    function show($project)
    {
        return view('projects.show', compact('project'));
    }
}
