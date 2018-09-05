<?php
/**
 * Class        Task
 * @package     App
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

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
