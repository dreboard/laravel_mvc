<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Project;
use App\Services\ProjectService;
use App\Services\CycleService;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    protected $projectService;
    /**
     * @var CycleService
     */
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

    /**
     * All projects route
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all();
        if($projects->isEmpty()){
            return redirect('project_new')->with('error', 'Please create a project');
        }
        return view('admin.projects.index');
    }

    /**
     * Create new project
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id = 0)
    {
        if($id !== 0){
            $cycle = Cycle::find($id);
        } else {
            $cycle = null;
        }
        $cycleListAll = $this->projectService->getOpenProjects();
        return view('admin.projects.new', ['cycleListAll' => $cycleListAll, 'cycle' => $cycle]);
    }

    /**
     * Save data from new project form
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
            $project_id = $this->projectService->processNewProject($request);
            return redirect()->route('project_view', ['id' => $project_id]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') === 'production'){
                \Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    /**
     * Get a project by id
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $project = Project::find($id);

        if($project === null){
            return redirect('project_new')->with('error', 'Please create a project');
        }

        return view('admin.projects.view')->with(['project' => $project]);
    }

    /**
     * Get all projects
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $projects = Project::all();
        return view('admin.projects.all', ['projects' => $projects]);
    }
}
