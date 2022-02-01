<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VitalFacility extends Model
{
    protected $fillable = [
        'name',
        'type_of_place_id',
        'date_added',
        'location_x',
        'location_y',
        'is_safe'
    ];

    protected $table = 'vitalFacility';

    public function typeOfPlace(){
        return $this->hasOne('App\TypeOfPlace', 'id', 'type_of_place_id');
    }

    public function getPathToIcon(){
        return $this->typeOfPlace->path_to_icon;
    }
}
