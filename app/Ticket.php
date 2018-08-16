<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App
 */
class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'create_date', 'due_date', 'status', 'project_id', 'created_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
