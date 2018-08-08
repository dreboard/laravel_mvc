<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'create_date', 'due_date', 'cycle_id', 'created_by'];

    public function cycle()
    {
        $this->hasOne('App\Cycle');
    }
}
