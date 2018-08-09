<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = ['title', 'start_date', 'end_date', 'git_tag', 'created_by'];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
