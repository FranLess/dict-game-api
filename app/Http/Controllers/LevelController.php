<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Http\Resources\LevelResource;
use App\Repositories\LevelRepository;
use Illuminate\Http\JsonResponse;

class LevelController extends Controller
{
    private $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LevelResource::collection(Level::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request)
    {
        $this->levelRepository->store($request->validated());
        return new JsonResponse(['message' => 'Level created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        return new LevelResource($level);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLevelRequest $request, Level $level)
    {
        $this->levelRepository->update($request->validated(), $level);
        return new JsonResponse(['message' => 'Level updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $this->levelRepository->destroy($level);
        return new JsonResponse(['message' => 'Level deleted successfully'], 204);
    }
}
