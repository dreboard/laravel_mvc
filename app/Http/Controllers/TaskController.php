<?php
/**
 * Class        TaskController
 * @package     App\Http\Controllers
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Http\Controllers;

use App\Http\Traits\TicketTrait;
use App\Repositories\Repository;
use App\Task;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{

    use TicketTrait;

    /**
     * @var Repository
     */
    protected $model;

    /**
     * TaskController constructor.
     * @param Model $task
     */
    /*public function __construct(Task $task)
    {
        $this->model = new Repository($task);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $this->model->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $task = new Task;
            $ticket = Ticket::find($request->ticket_id);

            if(Gate::allows('new-task', $ticket)){
                $task->title = $request->title;
                $task->user_id = $request->user_id;
                $task->ticket_id = $request->ticket_id;
                $task->complete = 0;
                $task->save();
                $this->allowed = 'Ticket Status Updated';
                $task_id = $task->id;
                return response()->json(['complete' => $request->task_complete, 'allowed' => $this->allowed, 'task_id' =>$task_id, 'title' =>$task->title], 200);
            }
            return response()->json(['complete' => 0, 'allowed' => 'Not allowed', 'task_id' => 0, 'title' => 'No Title'], 200);


        }catch (\Throwable $e){
            return response()->json(['complete'=>$e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified task status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $task = Task::find($request->task_id);
        try{
            if(Gate::allows('edit-task', $task)){
                if($request->has('task_complete')){
                    $task->complete = $request->task_complete;
                }
                if($request->has('task_title')){
                    throw_unless($request->filled('task_title'), \InvalidArgumentException::class);
                    $task->title = $request->task_title;
                }

                $task->save();
                return response()->json(['complete' => $request->task_complete, 'allowed' => 'Task Updated'], 200);
            }
            return response()->json(['complete' => $request->task_complete, 'allowed' => 'Not assigned this task'], 200);


        }catch (\Throwable $e){
            error_log($e->getMessage());
            return response()->json(['complete'=> $task->complete, 'allowed' => 'Task Not Updated']);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     * @todo create an authorized guard for deleting
     */
    public function destroy(Task $task)
    {
        //
    }
}
