<?php

use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\UserAuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get("companies/search", [CompanyController::class, 'search']);
Route::apiResource("companies", CompanyController::class);


Route::post('user/register', [UserAuthController::class, 'register']);
Route::post('user/login', [UserAuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/posts', [PostController::class, 'index']);
});
