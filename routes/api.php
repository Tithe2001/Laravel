<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');


    Route::post('logout', 'logout')->middleware('auth:sanctum');


    });

    Route::apiResource("customers", CustomerController::class);
    Route::apiResource("products", ProductController::class);
    Route::apiResource("orders", OrderController::class);
    Route::apiResource("roles", RoleController::class);
    Route::apiResource("users", UserController::class);
    Route::apiResource("divisions", DivisionController::class);
    Route::apiResource("districts", DistrictController::class);

