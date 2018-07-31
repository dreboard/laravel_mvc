<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Events\NewCycleEvent;
use App\Helpers\DateHelper;
use App\Http\Requests\CycleSaveRequest;
use App\Services\CycleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CycleController extends Controller
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

    public function showCycleForm()
    {
        $id = Auth::user( )->id;
        return view('admin.new_cycle', ['created_by' => $id]);
    }

    /**
     * Create a new cycle.
     * This method uses Manually Created Validators
     * @see https://laravel.com/docs/5.6/validation#manually-creating-validators
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveNewCycle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
        ]);

        if ($validator->fails()){
            return redirect('showCycleForm')
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $cycleInfo = $this->cycleService->processNewCycle($request);
            event(new NewCycleEvent());
            return view("admin.view_cycle", ["cycleInfo" => $cycleInfo]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') !== 'local'){
                \Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateCycle(CycleSaveRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
        ]);

        if ($validator->fails()){
            return redirect('allCycle')
                ->withErrors($validator)
                ->withInput();
        }
        Cycle::where('id', $request->input('id'))
            ->update([
                'title' => $request->input('title'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'git_tag' => $request->input('git_tag'),
                ]

        );

        $cycleInfo = Cycle::where('id', '=', $request->input('id'))->first();
        return view("admin.view_cycle", ["cycleInfo" => $cycleInfo]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllCycles()
    {
        $allCycles = Cycle::all();
        return view("admin.all_cycles", ["allCycles" => $allCycles]);
    }

    public function viewCycleById($id)
    {

        $cycleInfo = Cycle::where('id', '=', $id)->first();
        return view("admin.view_cycle", ["cycleInfo" => $cycleInfo]);
    }
}
