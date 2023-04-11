<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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
    Route::get('/getSignature', 'App\Http\Controllers\CloudinaryController@getSignature');
    Route::apiResource('videos', VideoController::class)->except(['index', 'show']);
    Route::apiResource('videos.comments', CommentController::class)->except(['index', 'show']);
    Route::apiSingleton('videos.likes', LikeController::class) 
    ->creatable()
    ->destroyable()
    ->except(['index', 'show']);
});

Route::apiResource('videos', VideoController::class)->only(['index', 'show']);
