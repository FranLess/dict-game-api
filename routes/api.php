<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HeartController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceptorTypeController;
use App\Http\Controllers\SentimentalController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    $user = $user->load('profile.country', 'profile.level', 'profile.sentimental', 'posts', 'comments', 'friends', 'hearts', 'sender_conversations', 'receptor_conversations', 'messages')->loadCount('friends', 'posts');

    return new UserResource($user);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('posts', PostController::class);

    Route::resource('comments', CommentController::class);

    Route::resource('conversations', ConversationController::class);

    Route::resource('friends', FriendController::class);

    Route::resource('hearts', HeartController::class);

    Route::resource('messages', MessageController::class);

    Route::middleware('admin')->resource('levels', LevelController::class);

    Route::middleware('admin')->resource('sentimentals', SentimentalController::class);

    Route::middleware('admin')->resource('receptor-types', ReceptorTypeController::class);

    Route::resource('images', ImageController::class);

    Route::resource('profiles', ProfileController::class);
});



Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json($token, 200);
});
