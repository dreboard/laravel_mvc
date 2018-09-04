<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'create_date', 'due_date', 'cycle_id', 'site_id', 'created_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cycle()
    {
        return $this->belongsTo('App\Cycle', 'cycle_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
