<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
// use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\TransactionsController;
use App\Http\Controllers\CollectionController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/getAllUser',[UserController::class,'getAllUser']);
Route::get('/getAllUserToo',[UserController::class,'getAllUser'])->middleware('auth:sanctum'); //harus login dulu
Route::get('/getAllCollection',[CollectionController::class,'getAllCollection']);
Route::get('/getAllCollectionToo',[CollectionController::class,'getAllCollection'])->middleware('auth:sanctum');
Route::get('/getAllTransactions', [TransactionsController::class,'getAllTransactions'] );
Route::get('/getAllTransactionsToo', [TransactionsController::class,'getAllTransactions'] )->middleware('auth:sanctum');//harus login dahulu

Route::middleware('auth:sanctum')->group( function() {
    Route::resources('collections', CollectionController::class);
});

    
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});