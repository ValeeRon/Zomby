<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VitalFacilities extends Model
{
    protected $fillable = [
        'name',
        'type_of_place_id',
        'date_added',
        'location',
        'is_safe'
    ];

    protected $table = 'vitalFacilities';

    public function typeOfPlace()
    {
        return $this->hasOne('App\TypeOfPlace', 'id', 'typeOfPlace_id');
    }

    public function getTypeOfPlaceName()
    {
        return $this->typeOfPlace->name;
    }
}
