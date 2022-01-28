<?php


namespace App\Repositories;


use App\VitalFacility;

class VitalFacilityRepository
{
    /**
     * @var VitalFacility $vitalFacility
     */
    protected $vitalFacility;

    /**
     * QualificationRepository constructor.
     * @param VitalFacility $vitalFacility
     */
    public function __construct(VitalFacility $vitalFacility)
    {
        $this->vitalFacility = $vitalFacility;
    }


    public function all()
    {
        return VitalFacility::all();
    }

    public function paginated($size)
    {
        return VitalFacility::paginate($size);
    }

    public function delete($id)
    {
        $this->vitalFacility->findOrFail($id)->delete();
    }
}
