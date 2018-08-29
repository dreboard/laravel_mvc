<?php

namespace App\Http\Controllers;

use App\Cycle;
use App\Events\NewCycleEvent;
use App\Helpers\DateHelper;
use App\Http\Requests\CycleSaveRequest;
use App\Services\SiteService;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    protected $siteService;

    /**
     * CycleController constructor.
     * @param SiteService $siteService
     */
    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
    }

    public function create()
    {
        $id = Auth::user( )->id;
        return view('admin.sites.new', ['created_by' => $id]);
    }

    /**
     * Create a new cycle.
     * This method uses Manually Created Validators
     * @see https://laravel.com/docs/5.6/validation#manually-creating-validators
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
        ]);

        if ($validator->fails()){
            return redirect('site_new')
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $siteInfo = $this->siteService->processNewSite($request);
            return view("admin.sites.view", ["siteInfo" => $siteInfo]);

        }catch (\Throwable $e){
            if(getenv('APP_ENV') === 'production'){
                \Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateCycle(Request $request)
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
        return view("admin.sites.view", ["cycleInfo" => $cycleInfo]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $allSites = Site::all();
        $count = Site::count();
        return view("admin.sites.all", ["allSites" => $allSites, 'count' => $count]);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projects(int $id)
    {
        $siteInfo = Site::find($id);
        return view("admin.sites.projects", ["siteInfo" => $siteInfo]);
    }

    public function calendar(int $id)
    {
        $siteInfo = Site::find($id);
        return view("admin.sites.calendar", ["siteInfo" => $siteInfo]);
    }
    public function show($id)
    {
        $siteInfo = Site::find($id);
        return view("admin.sites.view", ["siteInfo" => $siteInfo]);
    }

}
