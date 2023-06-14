<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Repositories\ProfileRepository;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProfileResource::collection(Profile::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $this->profileRepository->store($request->validated());
        return new JsonResponse(['message' => 'Profile created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        // return new JsonResponse(['data' => $request->validated()], 200);
        $this->profileRepository->update($request->validated(), $profile);
        return new JsonResponse(['message' => 'Profile updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $this->profileRepository->destroy($profile);
        return new JsonResponse(['message' => 'Profile deleted successfully'], 204);
    }
}
