<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
