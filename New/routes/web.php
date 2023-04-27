<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Middleware\AdminLoginMiddleware;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\User\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('home',[HomeController::class, 'home'])->name('home');
Route::get('products',[HomeController::class, 'products'])->name('products');
Route::get('blog',[HomeController::class, 'blog'])->name('blog');
Route::get('productDetails/{id}',[HomeController::class, 'productDetails'])->name('productDetails');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('login',[AuthController::class, 'login'])->name('login');

    Route::post('login',[AuthController::class, 'checklogin'])->name('checklogin');
});

Route::prefix('admin')->name('admin.')->middleware('admin.login')->group(function () {

    Route::get('profile',[AuthController::class, 'profile'])->name('profile');

    Route::put('profile',[AuthController::class, 'updateprofile'])->name('profile.update');

    Route::get('logout',[AuthController::class, 'logout'])->name('logout');

    Route::get('/',[AdminController::class, 'index'] )->name('dashboard');

    Route::prefix('categories')->name('categories.')->group(function() {

        Route::get('/',[CategoryController::class, 'index'])->name('index');

        Route::get('create',[CategoryController::class, 'create'])->name('create');

        Route::post('store',[CategoryController::class, 'store'])->name('store');

        Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('edit');

        Route::put('update/{id}',[CategoryController::class, 'update'])->name('update');

        Route::get('delete/{id}',[CategoryController::class, 'delete'])->name('delete');

        Route::prefix('news')->name('news.')->group(function() {

            Route::get('/',[NewController::class, 'index'])->name('index');
    
            Route::get('create',[NewController::class, 'create'])->name('create');
    
            Route::post('store',[NewController::class, 'store'])->name('store');
    
            Route::get('edit/{id}',[NewController::class, 'edit'])->name('edit');
    
            Route::put('update/{id}',[NewController::class, 'update'])->name('update');
    
            Route::get('delete/{id}',[NewController::class, 'delete'])->name('delete');
    
        });
    
        Route::prefix('products')->name('products.')->group(function() {
    
            Route::get('/',[ProductController::class, 'index'])->name('index');
    
            Route::get('create',[ProductController::class, 'create'])->name('create');
    
            Route::post('store',[ProductController::class, 'store'])->name('store');
    
            Route::get('edit/{id}',[ProductController::class, 'edit'])->name('edit');
    
            Route::put('update/{id}',[ProductController::class, 'update'])->name('update');
    
            Route::get('delete/{id}',[ProductController::class, 'delete'])->name('delete');
    
        });

    });

    

    Route::prefix('users')->name('users.')->group(function() {

        Route::get('/',[UserController::class, 'index'])->name('index');

        Route::get('create',[UserController::class, 'create'])->name('create');

        Route::post('store',[UserController::class, 'store'])->name('store');

        Route::get('edit/{id}',[UserController::class, 'edit'])->name('edit');

        Route::put('update/{id}',[UserController::class, 'update'])->name('update');

        Route::get('delete/{id}',[UserController::class, 'delete'])->name('delete');

    });

});

Route::prefix('user')->name('user.')->group(function(){
    Route::get('login',[AuthUserController::class, 'login'])->name('login');

    Route::post('login',[AuthUserController::class, 'checklogin'])->name('checklogin');

    Route::get('register',[AuthUserController::class, 'register'])->name('register');

    Route::post('register',[AuthUserController::class, 'postRegister'])->name('postRegister');

    Route::get('logout',[AuthUserController::class, 'logout'])->name('logout');

    Route::get('forgetpassword',[AuthUserController::class, 'forgetpassword'])->name('forgetpass');

    Route::post('postforgetpassword',[AuthUserController::class, 'postForgetpassword'])->name('postForgetpass');

    Route::get('emailsforgetpassword/{id}',[AuthUserController::class, 'emailsforgetpassword'])->name('emailsforgetpassword');

    Route::get('/getpassword/{id}',[AuthUserController::class, 'getPassword'])->name('getpassword');

    Route::put('/postgetpassword/{id}',[AuthUserController::class, 'postgetPassword'])->name('postgetpassword');
});

