<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Http\Requests\StoreFriendRequest;
use App\Http\Requests\UpdateFriendRequest;
use App\Http\Resources\FriendResource;
use App\Repositories\FriendRepository;
use Illuminate\Http\JsonResponse;

class FriendController extends Controller
{
    private $friendRepository;

    public function __construct(FriendRepository $friendRepository)
    {
        $this->friendRepository = $friendRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FriendResource::collection(Friend::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFriendRequest $request)
    {
        $this->friendRepository->store($request->validated());
        return new JsonResponse(['message' => 'Friend added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Friend $friend)
    {
        return new FriendResource($friend);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFriendRequest $request, Friend $friend)
    {
        $this->friendRepository->update($request->validated(), $friend);
        return new JsonResponse(['message' => 'Friend updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friend $friend)
    {
        $this->friendRepository->destroy($friend);
        return new JsonResponse(['message' => 'Friend deleted successfully'], 204);
    }
}
