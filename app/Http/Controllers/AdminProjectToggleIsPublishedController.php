<?php

namespace App\Http\Controllers;

use App\Models\Project;

class AdminProjectToggleIsPublishedController extends Controller
{
    public function toggleIsPublished(string $id)
    {
        $project = Project::find($id);

        $project->update([
            'is_published' => !$project->is_published,
        ]);

        return redirect()->back();
    }
}
