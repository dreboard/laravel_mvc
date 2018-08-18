<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Site
 * @package App
 */
class Site extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'url', 'ga', 'submitted', 'git_url', 'created_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
