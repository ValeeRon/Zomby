<?php


namespace App\Repositories;


use App\TypeOfPlace;

class TypeOfPlaceRepository
{
    /**
     * @var TypeOfPlace $typeOfPlace
     */
    protected $typeOfPlace;

    /**
     * QualificationRepository constructor.
     * @param TypeOfPlace $typeOfPlace
     */
    public function __construct(TypeOfPlace $typeOfPlace)
    {
        $this->typeOfPlace = $typeOfPlace;
    }


    public function all()
    {
        return TypeOfPlace::all();
    }

    public function paginated($size)
    {
        return TypeOfPlace::paginate($size);
    }

    public function delete($id)
    {
        $this->typeOfPlace->findOrFail($id)->delete();
    }
}
