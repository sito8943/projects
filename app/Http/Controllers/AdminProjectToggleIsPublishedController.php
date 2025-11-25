<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectPublishNotification;

class AdminProjectToggleIsPublishedController extends Controller
{
    public function toggleIsPublished(string $id)
    {
        $project = Project::find($id);

        $project->update([
            'is_published' => !$project->is_published,
        ]);

        if ($project->is_published) {
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                $admin->notify(new ProjectPublishNotification($project, auth()->user()));
            }
        }

        return redirect()->back();
    }
}
