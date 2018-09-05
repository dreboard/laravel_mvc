<?php
/**
 * @class        Project
 * @package     App
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

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
