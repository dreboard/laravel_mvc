<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App
 */
class Task extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['title', 'complete', 'user_id', 'assigned', 'ticket_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tickets()
    {
        return $this->belongsTo('App\Ticket');
    }
}
