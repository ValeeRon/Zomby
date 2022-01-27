<?php

namespace App\Http\Controllers;

use App\VitalFacilities;
use App\Repositories\VitalFacilitiesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VitalFacilitiesController extends Controller
{
    private $vitalFacilitiesRepository;

    public function __construct(VitalFacilitiesRepository $vitalFacilitiesRepository)
    {
        $this->vitalFacilitiesRepository = $vitalFacilitiesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $allVitalFacilities = $this->vitalFacilitiesRepository->all();
        foreach ($allVitalFacilities as $vitalFacility) {
            $vitalFacility['type_of_place'] = $vitalFacility->getTypeOfPlaceName();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        TypeOfPlace::create([
            'name' => $request->name,
            'type_of_place_id' => $request->type_of_place_id,
            'date_added' => $request->date_added,
            'location' => $request->location,
            'is_safe' => $request->is_safe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $facility = VitalFacilities::findOrFail($id);
        $facility->name = $request->name;
        $facility->type_of_place_id = $request->type_of_place_id;
        $facility->date_added = $request->date_added;
        $facility->location = $request->location;
        $facility->is_safe = $request->is_safe;
        $facility->save();
        return response(null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->vitalFacilitiesRepository->delete($id);
    }
}
