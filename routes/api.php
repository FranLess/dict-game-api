<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CountryController;
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
    // Route::resource('posts', PostController::class);
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/{post}', [PostController::class, 'show']);
        Route::post('/', [PostController::class, 'store']);
        Route::post('update/{post}', [PostController::class, 'update']);
        Route::post('delete/{post}', [PostController::class, 'destroy']);
    });

    // Route::resource('comments', CommentController::class);
    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentController::class, 'index']);
        Route::get('/{comment}', [CommentController::class, 'show']);
        Route::post('/', [CommentController::class, 'store']);
        Route::post('update/{comment}', [CommentController::class, 'update']);
        Route::post('delete/{comment}', [CommentController::class, 'destroy']);
    });

    // Route::resource('conversations', ConversationController::class);
    Route::prefix('conversations')->group(function () {
        Route::get('/', [ConversationController::class, 'index']);
        Route::get('/{conversation}', [ConversationController::class, 'show']);
        Route::post('/', [ConversationController::class, 'store']);
        Route::post('update/{conversation}', [ConversationController::class, 'update']);
        Route::post('delete/{conversation}', [ConversationController::class, 'destroy']);
    });

    // Route::resource('friends', FriendController::class);
    Route::prefix('friends')->group(function () {
        Route::get('/', [FriendController::class, 'index']);
        Route::get('/{friend}', [FriendController::class, 'show']);
        Route::post('/', [FriendController::class, 'store']);
        Route::post('update/{friend}', [FriendController::class, 'update']);
        Route::post('delete/{friend}', [FriendController::class, 'destroy']);
    });

    // Route::resource('hearts', HeartController::class);
    Route::prefix('hearts')->group(function () {
        Route::get('/', [HeartController::class, 'index']);
        Route::get('/{heart}', [HeartController::class, 'show']);
        Route::post('/', [HeartController::class, 'store']);
        Route::post('update/{heart}', [HeartController::class, 'update']);
        Route::post('delete/{heart}', [HeartController::class, 'destroy']);
    });

    // Route::resource('messages', MessageController::class);
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index']);
        Route::get('/{message}', [MessageController::class, 'show']);
        Route::post('/', [MessageController::class, 'store']);
        Route::post('update/{message}', [MessageController::class, 'update']);
        Route::post('delete/{message}', [MessageController::class, 'destroy']);
    });

    // Route::resource('levels', LevelController::class);
    Route::prefix('levels')->group(function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::get('/{level}', [LevelController::class, 'show']);
        Route::post('/', [LevelController::class, 'store']);
        Route::post('update/{level}', [LevelController::class, 'update']);
        Route::post('delete/{level}', [LevelController::class, 'destroy']);
    });

    // Route::resource('sentimentals', SentimentalController::class);
    Route::prefix('sentimentals')->group(function () {
        Route::get('/', [SentimentalController::class, 'index']);
        Route::get('/{sentimental}', [SentimentalController::class, 'show']);
        Route::post('/', [SentimentalController::class, 'store']);
        Route::post('update/{sentimental}', [SentimentalController::class, 'update']);
        Route::post('delete/{sentimental}', [SentimentalController::class, 'destroy']);
    });

    // Route::resource('receptor-types', ReceptorTypeController::class);
    Route::prefix('receptor-types')->group(function () {
        Route::get('/', [ReceptorTypeController::class, 'index']);
        Route::get('/{receptor-type}', [ReceptorTypeController::class, 'show']);
        Route::post('/', [ReceptorTypeController::class, 'store']);
        Route::post('update/{receptor-type}', [ReceptorTypeController::class, 'update']);
        Route::post('delete/{receptor-type}', [ReceptorTypeController::class, 'destroy']);
    });

    // Route::resource('images', ImageController::class);
    Route::prefix('images')->group(function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::get('/{image}', [ImageController::class, 'show']);
        Route::post('/', [ImageController::class, 'store']);
        Route::post('update/{image}', [ImageController::class, 'update']);
        Route::post('delete/{image}', [ImageController::class, 'destroy']);
    });

    // Route::resource('profiles', ProfileController::class);
    Route::prefix('profiles')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::get('/{profile}', [ProfileController::class, 'show']);
        Route::post('/', [ProfileController::class, 'store']);
        Route::post('update/{profile}', [ProfileController::class, 'update']);
        Route::post('delete/{profile}', [ProfileController::class, 'destroy']);
    });

    Route::get('/countries', [CountryController::class, 'index']);
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
