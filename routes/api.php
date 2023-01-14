<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\TodoController;
use App\Http\Controllers\api\UsersController;
use App\Models\Todo;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('users', UsersController::class);

Route::apiResource('todo', TodoController::class);

//protected
Route::middleware('auth:sanctum')->put('/todo/{id}', [TodoController::class, 'update']);
Route::middleware('auth:sanctum')->get('/todo/{id}', [TodoController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/todo', [TodoController::class, 'store']);


//not protected

Route::post("login", [LoginController::class, 'index']);

Route::post("logout", [LoginController::class, 'logout']);

Route::get("todo/", [TodoController::class, 'index']);

Route::get("todo/{id}/all", [TodoController::class, 'getall']);

Route::get("todo/{id}", [TodoController::class, 'show']);
