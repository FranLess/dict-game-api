<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Repositories\MessageRepository;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MessageResource::collection(Message::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $this->messageRepository->store($request->validated());
        return new JsonResponse(['message' => 'Message created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $this->messageRepository->update($request->validated(), $message);
        return new JsonResponse(['message' => 'Message updated successfully'], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $this->messageRepository->destroy($message);
        return new JsonResponse(['message' => 'Message deleted successfully'], 204);
    }
}
