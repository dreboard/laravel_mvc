<?php
/**
 * @since       v0.1.0
 * @package     Dev-PHP
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Http\Controllers;

use App\Cycle;
use App\Http\Traits\TicketTrait;
use App\Project;
use App\Services\ProjectService;
use App\Services\TicketService;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

/**
 * @class TicketController
 * @package App\Http\Controllers
 */
class TicketController extends Controller
{

    use TicketTrait;
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
     * Ticket home page
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
     * Show create ticket form
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
     * Save a new ticket
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
            $ticket_id = $this->ticketService->processNewTicket($request);
            return redirect()->route('ticket_view', ['id' => $ticket_id]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') === 'production'){
                \Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    /**
     * Get ticket by id
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
     * Show all tickets
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $projects = Project::all();
        $count = Project::count();
        return view('admin.projects.all', ['projects' => $projects]);
    }

    /**
     * Edit Ticket by id
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $ticket = Ticket::find($id);
        return view('admin.tickets.edit', ['ticket' => $ticket]);
    }

    /**
     * Update ticket status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        if(Gate::allows('edit-ticket', $ticket)){
            $ticket->status = $request->status;
            $ticket->save();
            $this->allowed = 'Ticket Status Updated';
        }
        return response()->json([
            'status' => $request->status,
            'allowed' => $this->allowed,
            'completed' => $ticket->completed
        ], 200);
    }

    /**
     * Update ticket percent complete
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeCompleted(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        if(Gate::allows('edit-ticket', $ticket)){
            $ticket->completed = $request->completed;
            $ticket->save();
            $this->allowed = 'Ticket Status Updated';
        }
        return response()->json(['completed' => $request->completed, 'allowed' => $this->allowed], 200);
    }
}
