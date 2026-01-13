<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TelemedicineController;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {


    Route::get("/", [DashboardController::class, "index"]);
    Route::get("/customer", [CustomerController::class, "index"]);
    Route::get("/customer/create", [CustomerController::class, "create"]);
    Route::POST("/customer/save", [CustomerController::class, "save"]);
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::put('/customer/update/{id}', [CustomerController::class, 'update']);
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete']);


    Route::get('/telemedicine', [TelemedicineController::class, 'index'])->name('telemedicine.index');
    Route::get('/telemedicine/create', [TelemedicineController::class, 'create'])->name('telemedicine.create');
    Route::get('/telemedicine/payment', [TelemedicineController::class, 'payment'])->name('telemedicine.payment');


    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/save', [ProductController::class, 'save'])->name('product.save');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');




// Route::get('/order', [OrderController::class, 'index'])->name('order.index');
//     Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
//     Route::post('/order', [OrderController::class, 'store'])->name('order.store');
//     Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
//     Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
//     Route::put('/order/{order}', [OrderController::class, 'update'])->name('order.update');
//     Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');













});



// Route::get('/', function () {
//     return view('layout.erp.app');
// });

Route::get("sendmail", function () {
    // Mail::to("is4901745@gmail.com")->send(new UserNotification);
    Mail::to("afrinakthertithebhuiyan@gmail.com")->send(new UserNotification);
    return "Mail has been sent successfully";
});

// dynamicmail

// Route::get("sendmail",);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/logout/', [LoginController::class, 'logout'])->name('logout');

Route::resource("orders",OrderController::class);
