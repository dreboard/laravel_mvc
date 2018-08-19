<?php

namespace App\Services;

use App\Site;
use App\Events\NewSiteEvent;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $site->url = $request->url;
        $site->ga = $request->ga;
        $site->submitted = $request->submitted;
        $site->git_url = $request->url;
        $site->created_by = Auth::user()->id;
        $site->save();

        event(new NewSiteEvent($site));

        $insertedId = $site->id;
        $siteInfo = Site::where('id', '=', $insertedId)->first();

        return $siteInfo;
    }

}