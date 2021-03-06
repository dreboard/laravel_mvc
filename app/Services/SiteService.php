<?php
/**
 * @class       SiteService
 * @package     App\Services
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Services;

use App\Site;
use App\Events\NewSiteEvent;
use App\Helpers\DateHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteService
{
    protected $model;

    /**
     * SiteService constructor.
     * @param Site $model
     */
    public function __construct(Site $model)
    {
        $this->model = $model;
    }

    /**
     * Process New Site
     * @param Request $request
     * @return mixed
     * @throws \Exception
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

        if(!$site->save()){
            throw new \Exception('Site not saved');
        }

        event(new NewSiteEvent($site));
        return $site;
    }

    /**
     * Get all sites and projects count
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function getUsersSites(User $user)
    {
        $sites = $user->sites;
        $userSites = [];
        foreach ($sites as $site){
            $site = Site::find($site->id);
            $userSites[] = [
                'id' => $site->id,
                'title' => $site->title,
                'description' => $site->description,
                'projects' => count($site->projects),
                'rate' => $site->rate,

            ];
        }
        return collect($userSites);
    }

}

