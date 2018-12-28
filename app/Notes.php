<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $fillable = ['note_date', 'note', 'ticket_id', 'project_id', 'site_id', 'project_id', 'created_by'];
}
