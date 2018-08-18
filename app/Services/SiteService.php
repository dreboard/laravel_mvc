<?php

namespace App\Services;

use App\Site;
use App\Events\NewSiteEvent;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;

/**
 * Class SiteService
 * @package App\Services
 */
class SiteService
{

    /**
     * Process New Site
     * @param Request $request
     * @return mixed
     */
    public function processNewSite(Request $request)
    {
        $site = new Site();
        $site->title = $request->title;
        $site->description = $request->description;
        $site->due_date = DateHelper::formatStartDate($request->input('due_date'));
        $site->create_date = DateHelper::formatStartDate($request->input('due_date'));
        $site->cycle_id = $request->cycle_id ?? 0;
        $site->created_by = Auth::user( )->id;
        $site->save();

        event(new NewSiteEvent($site));

        $insertedId = $site->id;
        $siteInfo = Site::where('id', '=', $insertedId)->first();

        return $siteInfo;
    }

    public function cycleList()
    {
        $siteList = Site::all();
        return $siteList;
        if($siteList->isEmpty()){
            return [];
        }
    }

}