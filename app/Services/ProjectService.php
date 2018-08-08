<?php
namespace App\Services;

use App\Project;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    public function processNewProject(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->due_date = DateHelper::formatStartDate($request->input('due_date'));
        $project->create_date = DateHelper::formatStartDate($request->input('due_date'));
        $project->cycle_id = $request->cycle_id ?? 0;
        $project->created_by = Auth::user( )->id;
        $project->save();

        return $project;
    }

    public function getProjectDetails(int $id)
    {
        $projectInfo = Project::findOrFail($id);
        return $projectInfo;
    }
}