<?php

namespace App\Http\Controllers;

use App\VitalFacility;
use App\Repositories\VitalFacilityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VitalFacilityController extends Controller
{
    private $vitalFacilityRepository;

    public function __construct(VitalFacilityRepository $vitalFacilityRepository)
    {
        $this->vitalFacilityRepository = $vitalFacilityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $allVitalFacility = $this->vitalFacilityRepository->all();
        return response()->json($allVitalFacility);
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
            'location_x' => $request->location_x,
            'location_y' => $request->location_y,
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
        $facility = VitalFacility::findOrFail($id);
        $facility->name = $request->name;
        $facility->type_of_place_id = $request->type_of_place_id;
        $facility->date_added = $request->date_added;
        $facility->location_x = $request->location_x;
        $facility->location_y = $request->location_y;
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
        $this->vitalFacilityRepository->delete($id);
    }
}
