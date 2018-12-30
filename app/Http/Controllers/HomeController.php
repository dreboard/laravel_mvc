<?php
/**
 * @class        HomeController
 * @package     App\Http\Controllers
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Http\Controllers;

use App\{Services\SiteService, User, Site};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $siteService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $projects = count($user->projects);
        $userSites = $this->siteService->getUsersSites($user);
        //For adminlte
        //return view('admin.home', ['tasks' => $tasks]);
        return view('admin.dash', ['user' => $user, 'projects' => $projects, 'userSites' => $userSites]);
    }

    /**
     * Show the front page.
     *
     * @return \Illuminate\Http\Response
     */
    public function frontPage()
    {
        return view('front.home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pageTwo()
    {
        //return view('home');
        return view('admin.page2');
    }
}
