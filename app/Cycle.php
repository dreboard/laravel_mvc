<?php
/**
 * @class        Cycle
 * @package     App
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = ['title', 'start_date', 'end_date', 'git_tag', 'created_by'];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
