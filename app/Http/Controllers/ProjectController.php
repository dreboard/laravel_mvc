<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Project;
use App\Services\ProjectService;
use App\Services\CycleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $projectService;
    protected $cycleService;

    /**
     * CycleController constructor.
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService, CycleService $cycleService)
    {
        $this->projectService = $projectService;
        $this->cycleService = $cycleService;
    }

    public function index()
    {
        $projects = Project::all();
        if($projects->isEmpty()){
            return redirect('project_new')->with('error', 'Please create a project');
        }
        return view('admin.projects.index');
    }

    public function create($id = 0)
    {
        if($id !== 0){
            $cycle = Cycle::find($id);
        } else {
            $cycle = null;
        }
        $cycleListAll = $this->cycleService->cycleList();
        return view('admin.projects.new', ['cycleListAll' => $cycleListAll, 'cycle' => $cycle]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required| max:100',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return redirect('project_new')
                ->withErrors($validator)
                ->withInput();
        }

        try{
            $projectSave = $this->projectService->processNewProject($request);
            $project = $this->projectService->getProjectDetails($projectSave->id);
            return view('admin.projects.view')->with(['project' => $project]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') === 'production'){
                \Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    public function show($id)
    {
        $project = Project::where('id', '=', $id)->first();
        if($project === null){
            return redirect('project_new')->with('error', 'Please create a project');
        }
        return view('admin.projects.view')->with(['project' => $project]);
    }
}
