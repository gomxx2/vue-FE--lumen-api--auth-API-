<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * @var string
     */
    protected $table = 'contact';

    /**
     * @var array
     */
    protected $fillable = [
        'salutation', 'first_name','email','mobile_numb'
    ];
}