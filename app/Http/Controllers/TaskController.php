<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{

    /**
     * @var Repository
     */
    protected $model;

    /**
     * TaskController constructor.
     * @param Model $task
     */
    public function __construct(Model $task)
    {
        $this->model = new Repository($task);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->all();
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
        //
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
        //$task = $this->model->findOrFail($request->task_id);

        try{
            DB::table('tasks')
                ->where('id', $request->task_id)
                ->update(['complete' => $request->task_complete]);
            return response()->json(['updated'=>'Data is successfully added']);
        }catch (\Throwable $e){
            return response()->json(['error'=>$e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
