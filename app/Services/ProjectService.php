<?php
namespace App\Services;

use App\Project;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProjectService
 * @package App\Services
 */
class ProjectService
{
    /**
     * Create a new project
     * @param Request $request
     * @return mixed
     */
    public function processNewProject(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->due_date = DateHelper::formatStartDate($request->input('due_date'));
        $project->create_date = DateHelper::formatStartDate($request->input('due_date'));
        $project->cycle_id = $request->cycle_id ?? 0;
        $project->site_id = $request->site_id ?? 0;
        $project->created_by = Auth::user( )->id;
        $project->save();

        return $project->id;
    }

    /**
     * Get project by ID
     * @param int $id
     * @return mixed
     */
    public function getProjectDetails(int $id)
    {
        $projectInfo = Project::findOrFail($id);
        return $projectInfo;
    }

    /**
     * Get all projects
     * @return Project[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getOpenProjects()
    {
        $projects = Project::all();
        return $projects;
    }
}