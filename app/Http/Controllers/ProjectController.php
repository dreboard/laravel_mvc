<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Project;
use App\Services\CycleService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $cycleService;

    /**
     * CycleController constructor.
     * @param CycleService $cycleService
     */
    public function __construct(CycleService $cycleService)
    {
        $this->cycleService = $cycleService;
    }

    public function index()
    {
        $projects = Project::all();
        if($projects->isEmpty()){
            return redirect('project.new');
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
}
