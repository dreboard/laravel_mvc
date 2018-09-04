<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App
 */
class Project extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'create_date', 'due_date', 'cycle_id', 'site_id', 'created_by'];

    /**
     * Cycle model relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cycle()
    {
        return $this->belongsTo('App\Cycle', 'cycle_id');
    }

    /**
     * Site model relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    /**
     * Ticket model relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
