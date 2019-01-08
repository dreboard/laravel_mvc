<?php
/**
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Http\Controllers;

use App\Cycle;
use App\Events\NewCycleEvent;
use App\Helpers\DateHelper;
use App\Http\Requests\CycleSaveRequest;
use App\Http\Traits\MessageTrait;
use App\Services\SiteService;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @class SiteController
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    use MessageTrait;
    /**
     * @var SiteService
     */
    protected $siteService;
    private $user;

    /**
     * CycleController constructor.
     * @param SiteService $siteService
     */
    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
        $this->user = Auth::user();
    }

    /**
     * New site form view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sites.new');
    }

    /**
     * Create a new Site.
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
                Log::error($e->getMessage());
                return back()->withErrors(['field_name' => ['Your data could not be saved.']]);
            }
            return back()->withErrors(['exception' => [$e->getMessage()]]);
        }
    }

    /**
     * Get all Sites
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $sites = Site::all();
        $count = Site::count();
        return view("admin.sites.all", ["allSites" => $sites, 'count' => $count]);
    }

    /**
     * @codeCoverageIgnore
     * @deprecated v2.0.0
     * @todo remove as of version 2.0.0
     */
    public function projects(int $id)
    {
        try{
            $siteInfo = Site::findOrFail($id);
            return view("admin.sites.projects", ["siteInfo" => $siteInfo]);
        } catch (\Throwable $e){
            return redirect()->back()->with('errors', $this->envMessage($e));
        }
    }


    /**
     * @codeCoverageIgnore
     * @deprecated v2.0.0
     * @todo remove as of version 2.0.0
     */
    public function calendar(int $id)
    {
        $siteInfo = Site::find($id);
        return view("admin.sites.calendar", ["siteInfo" => $siteInfo]);
    }

    /**
     * Get requested site by ID
     * @param Site $site
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Site $site)
    {
        try {
            if(Auth::user()->can('view', $site)){
                return view("admin.sites.view", compact('site'));
            }
            return back()->withErrors(['errors' => ['Not Authorized']]);
        } catch (ModelNotFoundException $exception) {
            if (getenv('APP_ENV') === 'local') {
                $msg = $exception->getMessage();
            } else {
                $msg = 'Site Not Found';
                Log::channel('site')->error($exception->getMessage());
            }
            return back()->withErrors(['errors' => [$msg]]);
        }
    }

}
