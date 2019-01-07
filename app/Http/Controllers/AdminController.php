<?php
/**
 * @since       v1.0.4
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('adminLogin');
    }
    /**
     * Get all Users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $users = User::all();
        $count = User::count();
        return view("admin.users.all", ["users" => $users, 'count' => $count]);
    }

    /**
     * Get user by id
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(int $id)
    {
        try {
            $user = User::findOrFail($id);
            return view("admin.users.view", ["user" => $user]);
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


    /**
     * Clone a user
     * @param int $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cloneUser(int $user_id )
    {
        $new_user = User::find( $user_id );
        Session::put( 'admin_user', Auth::id() );
        Auth::login( $new_user );
        return redirect()->action('HomeController@index');
    }

    /**
     * Reset logged in admin user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLogin()
    {
        $id = Session::pull( 'admin_user' );
        $admin_user = User::find( $id );
        Auth::login( $admin_user );
        return redirect()->action('AdminController@all');
    }

}
