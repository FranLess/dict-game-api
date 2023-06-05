<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\ImageResource;
use App\Repositories\ImageRepository;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    private $imageRepository;
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ImageResource::collection(Image::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $this->imageRepository->store($request->validated());
        return new JsonResponse(['message' => 'Image created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return new ImageResource($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $this->imageRepository->update($request->validated(), $image);
        return new JsonResponse(['message' => 'Image updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $this->imageRepository->destroy($image);
        return new JsonResponse(['message' => 'Image deleted successfully'], 204);
    }
}
