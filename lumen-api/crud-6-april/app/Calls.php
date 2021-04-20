<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calls extends Model
{
    /**
     * @var string
     */
    protected $table = 'calls';

    /**
     * @var array
     */
    protected $fillable = [
        'subject', 'Description','status_call','status_direction','Parent_type'
        ,'relate','start_date','calls_owner'
    ];
}