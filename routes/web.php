<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
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
    Route::get('customer/find/{id}', [CustomerController::class, 'find']);



    Route::get('/telemedicine', [TelemedicineController::class, 'index'])->name('telemedicine.index');
    Route::get('/telemedicine/create', [TelemedicineController::class, 'create'])->name('telemedicine.create');
    Route::get('/telemedicine/payment', [TelemedicineController::class, 'payment'])->name('telemedicine.payment');


    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/save', [ProductController::class, 'save'])->name('product.save');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');



Route::prefix('purchases')->group(function () {

    Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/store', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::put('/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
});

Route::prefix('stocks')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('stocks.index');
});

















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
