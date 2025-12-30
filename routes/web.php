<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function(){


    Route::get("/",[DashboardController::class,"index"]);
    Route::get("/customer",[CustomerController::class,"index"]);
    Route::get("/customer/create",[CustomerController::class,"create"]);
    Route::POST("/customer/save",[CustomerController::class,"save"]);
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::put('/customer/update/{id}', [CustomerController::class, 'update']);
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete']);

});



// Route::get('/', function () {
//     return view('layout.erp.app');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/logout/',[LoginController::class, 'logout'])->name('logout');
