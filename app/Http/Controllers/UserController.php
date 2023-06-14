<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getCurrent(Request $request)
    {
        $user = $request->user();
        $user = $user->load(
            'profile.country',
            'profile.level',
            'profile.sentimental',
            'posts',
            'comments',
            'friends.sender.profile',
            'friends.receptor.profile',
            'friendsRequests.sender.profile',
            'friendsRequests.receptor.profile',
            'hearts',
            'sender_conversations.sender.profile',
            'sender_conversations.receptor.profile',
            'sender_conversations.messages',
            'receptor_conversations.messages',
            'receptor_conversations.sender.profile',
            'receptor_conversations.receptor.profile',
            'messages'
        )->loadCount('friends', 'posts');

        return new UserResource($user);
    }

    function get(User $user)
    {
        return new UserResource($user->load(
            'profile.country',
            'profile.level',
            'profile.sentimental',
            'posts',
            'comments',
            'friends',
            'hearts',
            'sender_conversations',
            'receptor_conversations',
            'messages'
        )->loadCount('friends', 'posts'));
    }

    function index()
    {
        return UserResource::collection(User::with('profile')->paginate());
    }
}
