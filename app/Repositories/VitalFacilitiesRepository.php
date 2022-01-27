<?php


namespace App\Repositories;


use App\VitalFacilities;

class VitalFacilitiesRepository
{
    /**
     * @var VitalFacilities $vitalFacilities
     */
    protected $vitalFacilities;

    /**
     * QualificationRepository constructor.
     * @param VitalFacilities $vitalFacilities
     */
    public function __construct(VitalFacilities $vitalFacilities)
    {
        $this->vitalFacilities = $vitalFacilities;
    }


    public function all()
    {
        return VitalFacilities::all();
    }

    public function paginated($size)
    {
        return VitalFacilities::paginate($size);
    }

    public function delete($id)
    {
        $this->vitalFacilities->findOrFail($id)->delete();
    }
}
