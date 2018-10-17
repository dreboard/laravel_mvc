<?php
/**
 * @class       CycleService
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

class CycleService
{

    /**
     * Process New Cycle
     * @param Request $request
     * @return mixed
     */
    public function processNewCycle(Request $request)
    {
        $cycle = new Cycle();
        $cycle->title = $request->title;
        $cycle->start_date = DateHelper::formatStartDate($request->input('start_date'));
        $cycle->end_date = DateHelper::formatEndDate($cycle->start_date, $request->input('end_date'));
        $cycle->git_tag = $request->git_tag ?? 'v0.0.0';
        $cycle->created_by = $request->created_by;
        $cycle->save();

        event(new NewCycleEvent($cycle));

        $insertedId = $cycle->id;
        $cycleInfo = Cycle::where('id', '=', $insertedId)->first();

        return $cycleInfo;
    }

    public function cycleList()
    {
        $cycleList = Cycle::all();
        return $cycleList;
        if($cycleList->isEmpty()){
            return [];
        }
    }

}