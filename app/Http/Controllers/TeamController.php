<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepository;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TeamResource::collection(Team::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $this->teamRepository->store($request->all());
        return new JsonResponse(['message' => 'Team created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return new TeamResource($team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        return $this->teamRepository->update($team, $request->all());
        return new JsonResponse(['message' => 'Team updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $this->teamRepository->destroy($team);
        return new JsonResponse(['message' => 'Team deleted successfully'], 204);
    }
}
