<?php
/**
 * @class       UserService
 * @package     App\Services
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Services;

use App\Cycle;
use App\Events\NewCycleEvent;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;

class UserService
{

    /**
     * Process New User
     * @param Request $request
     * @return mixed
     */
    public function processNewUser(Request $request)
    {
        $user = new User();
        $user->title = $request->title;
        $user->start_date = DateHelper::formatStartDate($request->input('start_date'));
        $user->end_date = DateHelper::formatEndDate($user->start_date, $request->input('end_date'));
        $user->git_tag = $request->git_tag ?? 'v0.0.0';
        $user->created_by = $request->created_by;
        $user->save();

        //event(new NewCycleEvent($user));

        $insertedId = $user->id;
        $userInfo = User::where('id', '=', $insertedId)->first();

        return $userInfo;
    }

    public function saveHomePage(string $link)
    {
        $userList = User::all();
        return $userList;
        if($userList->isEmpty()){
            return [];
        }
    }

}