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

        // TODO add logic to send publish email here

        return redirect()->back();
    }
}
