<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\PFCController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [LoginController::class, 'register']);

Route::middleware('auth:sanctum')->post('/checkLogin', function(Request $request){
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/today', [GetController::class, 'getByDate']);

Route::middleware('auth:sanctum')->post('/weight/update', WeightController::class);
Route::middleware('auth:sanctum')->post('/pfc/update', PFCController::class);

Route::middleware('auth:sanctum')->post('products/update', [ProductController::class, 'update']);
Route::middleware('auth:sanctum')->post('products/delete', [ProductController::class, 'delete']);
Route::middleware('auth:sanctum')->post('products/new', [ProductController::class, 'new']);

Route::middleware('auth:sanctum')->post('products/presearch', [SearchController::class, 'presearch']);
Route::middleware('auth:sanctum')->post('products/search', [SearchController::class, 'search']);
