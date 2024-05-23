<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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

//login
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//products
Route::apiResource('/api-products', ProductController::class)->middleware('auth:sanctum');
// Route::get('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'getById']);
// Route::post('/products', [App\Http\Controllers\Api\ProductController::class, 'store']);
// Route::put('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'update']);
// Route::delete('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'getAll'])->middleware('auth:sanctum');
