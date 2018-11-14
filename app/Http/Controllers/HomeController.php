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

use App\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $tasks = Ticket::all();
        return view('admin.home', ['tasks' => $tasks]);
        //return view('admin.dash', ['tasks' => $tasks]);
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
