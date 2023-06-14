<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;
use App\Http\Resources\ConversationResource;
use App\Repositories\ConversationRepository;
use Illuminate\Http\JsonResponse;

class ConversationController extends Controller
{
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepository)
    {
        $this->conversationRepository = $conversationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConversationResource::collection(Conversation::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConversationRequest $request)
    {
        $conversation = $this->conversationRepository->store($request->validated());
        return new JsonResponse(['message' => 'Conversation created successfully', 'id' => $conversation->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        return new ConversationResource($conversation->load('sender.profile', 'receptor.profile', 'messages.user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConversationRequest $request, Conversation $conversation)
    {
        $this->conversationRepository->update($request->validated(), $conversation);
        return new JsonResponse(['message' => 'Conversation updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        $this->conversationRepository->destroy($conversation);
        return new JsonResponse(['message' => 'Conversation deleted successfully'], 204);
    }
}
