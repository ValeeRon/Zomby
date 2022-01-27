<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfPlace extends Model
{
    protected $fillable = [
        'name',
        'path_to_icon'
    ];

    protected $table = 'typeOfPlace';
}
