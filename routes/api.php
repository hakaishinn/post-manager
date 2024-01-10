<?php

use App\Http\Controllers\Api\AdvertiseController;
use App\Http\Controllers\Api\ApiKeyController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WebsiteController;

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
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
// Route::get('/refresh-token', [AuthController::class, 'getRefreshToken']);

Route::middleware('auth:api')->group(function(){
    Route::get('/create-api-key', [ApiKeyController::class, 'createApiKey']);
});

Route::middleware(['auth.apikey'])->group(function(){
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/tags', [TagController::class, 'index']);
    Route::get('/authors', [UserController::class, 'index']);
    Route::get('/advertises', [AdvertiseController::class, 'index']);
    Route::get('/websites', [WebsiteController::class, 'index']);
    Route::get('/menus', [MenuController::class, 'index']);
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/colors', [ColorController::class, 'index']);
});

Route::get('/unauthorized', function(){
    return response([
        'errors' => [[
            'message' => 'Unauthorized'
        ]]
    ], 401);
})->name('unauthorized');