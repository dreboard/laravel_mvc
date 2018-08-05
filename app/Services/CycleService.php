<?php

namespace App\Services;

use App\Cycle;
use App\Events\NewCycleEvent;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;

/**
 * Class CycleService
 * @package App\Services
 */
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

}