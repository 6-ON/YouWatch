<?php

use App\Http\Controllers\BannedVideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\User\VideosController;
use App\Http\Controllers\VideoBanController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/tags', [VideoController::class, 'tags']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiSingleton('profile', ProfileController::class)
        ->destroyable()
        ->only(['update', 'destroy']);

    Route::get('/getSignature', 'App\Http\Controllers\CloudinaryController@getSignature');

    Route::apiResource('videos', VideoController::class)->except(['index', 'show']);

    Route::apiResource('videos.comments', CommentController::class)->except(['index', 'show']);

    Route::apiSingleton('videos.likes', LikeController::class)
        ->creatable()
        ->destroyable()
        ->except(['index', 'show']);

    Route::get('/history', [HistoryController::class, 'index'])->name('history');

    Route::apiSingleton('users.subs', SubscribeController::class)
        ->creatable()
        ->destroyable()->only(['store', 'destroy']);

    Route::apiSingleton('videos.ban', VideoBanController::class)
        ->creatable()
        ->destroyable()->only(['store', 'destroy']);

    Route::get('banned/videos', BannedVideoController::class . '@index')->name('videos.ban.index');


    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions');
});
// create a route for video view  with a rate limiter and auth middleware
Route::middleware('throttle:views')->group(function () {
    Route::get('/videos/{video}/view', [VideoController::class, 'view'])->name('videos.view');
});
Route::get('users/{user:username}/videos', [VideosController::class, 'index'])->name('users.videos.index');


Route::apiResource('videos', VideoController::class)->only(['index', 'show']);
