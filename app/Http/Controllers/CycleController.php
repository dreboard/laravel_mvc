<?php

namespace App\Http\Controllers;

use App\Cycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CycleController extends Controller
{
    public function __construct()
    {

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
            $cycle = new Cycle();
            $cycle->title = $request->title;
            $cycle->start_date = date( "Y-m-d", strtotime( $request->start_date ) ) ?? date('Y-m-d');
            $cycle->end_date = date( "Y-m-d", strtotime( $request->end_date ) ) ?? date('Y-m-d');
            $cycle->git_tag = $request->git_tag ?? 'v0.0.0';
            $cycle->created_by = $request->created_by;
            $cycle->save();
            $insertedId = $cycle->id;
            $cycleInfo = Cycle::where('id', '=', $insertedId)->first();
            //dd($cycleInfo);
            return view("admin.view_cycle", ["cycleInfo" => $cycleInfo]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') == 'local'){
                return back()->withErrors(['exception' => [$e->getMessage()]]);
            }
            return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
        }
    }

    public function getAllCycles()
    {
        $allCycles = Cycle::all();
        return view("admin.all_cycles", ["allCycles" => $allCycles]);
    }
}
