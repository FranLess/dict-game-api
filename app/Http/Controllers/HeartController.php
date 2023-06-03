<?php

namespace App\Http\Controllers;

use App\Models\Heart;
use App\Http\Requests\StoreHeartRequest;
use App\Http\Requests\UpdateHeartRequest;
use App\Http\Resources\HeartResource;
use App\Repositories\HeartRepository;
use Illuminate\Http\JsonResponse;

class HeartController extends Controller
{
    private $heartRepository;
    public function __construct(HeartRepository $heartRepository)
    {
        $this->heartRepository = $heartRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HeartResource::collection(Heart::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeartRequest $request)
    {
        $this->heartRepository->store($request->validated());
        return new JsonResponse(['message' => 'success'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Heart $heart)
    {
        return new HeartResource($heart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeartRequest $request, Heart $heart)
    {
        $this->heartRepository->update($request->validated(), $heart);
        return new JsonResponse(['message' => 'success'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Heart $heart)
    {
        $this->heartRepository->destroy($heart);
        return new JsonResponse(['message' => 'success'], 204);
    }
}
