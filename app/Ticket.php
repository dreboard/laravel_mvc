<?php
/**
 * Class        Ticket
 * @package     App
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
