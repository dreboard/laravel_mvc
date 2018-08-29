<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Project;
use App\Services\ProjectService;
use App\Services\TicketService;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class TicketController
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{
    /**
     * @var ProjectService
     */
    protected $projectService;
    /**
     * @var TicketService
     */
    protected $ticketService;

    /**
     * CycleController constructor.
     * @param ProjectService $projectService
     * @param TicketService $ticketService
     */
    public function __construct(ProjectService $projectService, TicketService $ticketService)
    {
        $this->projectService = $projectService;
        $this->ticketService = $ticketService;
    }

    /**
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
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id = 0)
    {
        if($id !== 0){
            $project = Project::find($id);
        } else {
            $project = null;
        }
        $projects = Project::all();
        return view('admin.tickets.new', ['projects' => $projects, 'project' => $project]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required| max:100',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return redirect('ticket_new')
                ->withErrors($validator)
                ->withInput();
        }

        try{
            $ticket = $this->ticketService->processNewTicket($request);
            return view('admin.tickets.view')->with(['ticket' => $ticket]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') === 'production'){
                \Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        if($ticket === null){
            return redirect('ticket_new')->with('error', 'Please create a new ticket');
        }
        return view('admin.tickets.view')->with(['ticket' => $ticket]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $projects = Project::all();
        $count = Project::count();
        return view('admin.projects.all', ['projects' => $projects]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        DB::table('tickets')
            ->where('id', $request->ticket_id)
            ->update(['status' => $request->status]);

        return response()->json(['success'=>'Data is successfully added']);
    }

    public function changeCompleted(Request $request)
    {
        DB::table('tickets')
            ->where('id', $request->ticket_id)
            ->update(['completed' => $request->completed]);

        return response()->json(['completed' => $request->completed]);
    }
}
