<?php

namespace App\Http\Controllers;

use App\Models\ReceptorType;
use App\Http\Requests\StoreReceptorTypeRequest;
use App\Http\Requests\UpdateReceptorTypeRequest;
use App\Http\Resources\ReceptorTypeResource;
use App\Repositories\ReceptorTypeRepository;
use Illuminate\Http\JsonResponse;

class ReceptorTypeController extends Controller
{
    private $receptorTypeRepository;

    public function __construct(ReceptorTypeRepository $receptorTypeRepository)
    {
        $this->receptorTypeRepository = $receptorTypeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReceptorTypeResource::collection(ReceptorType::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReceptorTypeRequest $request)
    {
        $this->receptorTypeRepository->store($request->all());
        return new JsonResponse(['message' => 'ReceptorType created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceptorType $receptorType)
    {
        return new ReceptorTypeResource($receptorType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceptorTypeRequest $request, ReceptorType $receptorType)
    {
        $this->receptorTypeRepository->update($request->validated(), $receptorType);
        return new JsonResponse(['message' => 'ReceptorType updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceptorType $receptorType)
    {
        $this->receptorTypeRepository->destroy($receptorType);
        return new JsonResponse(['message' => 'ReceptorType deleted successfully'], 204);
    }
}
