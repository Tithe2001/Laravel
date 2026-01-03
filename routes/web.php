<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TelemedicineController;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function(){


    Route::get("/",[DashboardController::class,"index"]);
    Route::get("/customer",[CustomerController::class,"index"]);
    Route::get("/customer/create",[CustomerController::class,"create"]);
    Route::POST("/customer/save",[CustomerController::class,"save"]);
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::put('/customer/update/{id}', [CustomerController::class, 'update']);
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete']);


    Route::get('/telemedicine', [TelemedicineController::class, 'index']);

});



// Route::get('/', function () {
//     return view('layout.erp.app');
// });

Route::get("sendmail",function(){
    Mail::to("is4901745@gmail.com")->send(new UserNotification);
    return "Mail has been sent successfully";
});

// dynamicmail

// Route::get("sendmail",);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/logout/',[LoginController::class, 'logout'])->name('logout');
