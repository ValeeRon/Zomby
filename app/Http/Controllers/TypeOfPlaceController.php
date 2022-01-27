<?php

namespace App\Http\Controllers;

use App\TypeOfPlace;
use App\Repositories\TypeOfPlaceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeOfPlaceController extends Controller
{
    private $typeOfPlaceRepository;

    public function __construct(TypeOfPlaceRepository $typeOfPlaceRepository)
    {
        $this->typeOfPlaceRepository = $typeOfPlaceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $allTypeOfPlace = $this->typeOfPlaceRepository->all();
        return response()->json($allTypeOfPlace);
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
            'path_to_icon' => $request->path_to_icon,
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
        $type = TypeOfPlace::findOrFail($id);
        $type->name = $request->name;
        $type->path_to_icon = $request->path_to_icon;
        $type->save();
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
        $this->typeOfPlaceRepository->delete($id);
    }
}
