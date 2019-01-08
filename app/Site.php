<?php
/**
 * @class        Site
 * @package     App
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'url', 'ga', 'submitted', 'git_url', 'created_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
