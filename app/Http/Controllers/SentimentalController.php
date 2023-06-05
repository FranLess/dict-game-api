<?php

namespace App\Http\Controllers;

use App\Models\Sentimental;
use App\Http\Requests\StoreSentimentalRequest;
use App\Http\Requests\UpdateSentimentalRequest;
use App\Http\Resources\SentimentalResource;
use App\Repositories\SentimentalRepository;
use Illuminate\Http\JsonResponse;

class SentimentalController extends Controller
{
    private $sentimentalRepository;

    public function __construct(SentimentalRepository $sentimentalRepository)
    {
        $this->sentimentalRepository = $sentimentalRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SentimentalResource::collection(Sentimental::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSentimentalRequest $request)
    {
        $this->sentimentalRepository->store($request->validated());
        return new JsonResponse(['message' => 'Sentimental created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sentimental $sentimental)
    {
        return new SentimentalResource($sentimental);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSentimentalRequest $request, Sentimental $sentimental)
    {
        $this->sentimentalRepository->update($request->validated(), $sentimental);
        return new JsonResponse(['message' => 'Sentimental updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentimental $sentimental)
    {
        $this->sentimentalRepository->destroy($sentimental);
        return new JsonResponse(['message' => 'Sentimental deleted successfully'], 204);
    }
}
