<?php

namespace App\Policies;

use App\User;
use App\Site;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability): ?bool
    {
        if ($user->isAdmin == 1) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the site.
     *
     * @param  \App\User  $user
     * @param  \App\Site  $site
     * @return mixed
     */
    public function view(User $user, Site $site)
    {
        return $user->id === $site->created_by;
    }

    /**
     * Determine whether the user can create sites.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the site.
     *
     * @param  \App\User  $user
     * @param  \App\Site  $site
     * @return mixed
     */
    public function update(User $user, Site $site)
    {
        //
    }

    /**
     * Determine whether the user can delete the site.
     *
     * @param  \App\User  $user
     * @param  \App\Site  $site
     * @return mixed
     */
    public function delete(User $user, Site $site)
    {
        //
    }

    /**
     * Determine whether the user can restore the site.
     *
     * @param  \App\User  $user
     * @param  \App\Site  $site
     * @return mixed
     */
    public function restore(User $user, Site $site)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the site.
     *
     * @param  \App\User  $user
     * @param  \App\Site  $site
     * @return mixed
     */
    public function forceDelete(User $user, Site $site)
    {
        //
    }
}
