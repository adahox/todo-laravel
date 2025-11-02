<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return response()->json([
        'all right'
    ], 200);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::resource('todo', TodoController::class)->missing(function (Request $request) {
    return response()->error('Not Found.', 404);
})->middleware(['auth:sanctum']);
