<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\Auth\ForgotPasswordController;
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

Route::get('/', function () {
    return view('auth.login');
    // resources/views/welcome.blade.php
});

// localhost/shopify/public/home
Route::get('login', [UserAuthController::class,'login'])->middleware('AlreadyLoggedIn') ;
Route::get('register', [UserAuthController::class,'register'])->middleware('AlreadyLoggedIn') ;
Route::post('create',[UserAuthController::class,'create'])->name('auth.create');
Route::post('check',[UserAuthController::class,'check'])->name('auth.check');

Route::get('verify-email/{verification_code}', [UserAuthController::class,'verify_email'])->name('verify_email')->middleware('AlreadyLoggedIn') ;




Auth::routes(['verify' => true]);

Route::get('logout', [UserAuthController::class,'logout']);

//user
Route::get('profile', [UserAuthController::class,'profile'])->middleware('isLogged') ;
Route::get('edit_profile', [UserAuthController::class,'editprofile'])->middleware('isLogged') ;
Route::post('update',[UserAuthController::class,'update'])->name('auth.update');
Route::post('upload',[UserAuthController::class,'upload_avantar'])->name('auth.upload');
Route::post('edit_profile/remove',[UserAuthController::class,'remove_avantar'])->name('auth.remove');




//admin
Route::get('admin_login', [AdminAuthController::class,'login']) ;
Route::get('admin_register',[LocationController::class,'index'],[AdminAuthController::class,'register']) ;// [AdminAuthController::class,'register'],
Route::post('admin_register/fetch',[LocationController::class,'fetch'])->name('dynamicdependent.fetch');

Route::post('admin_create',[AdminAuthController::class,'create'])->name('admin.create'); //view path
Route::post('admin_check',[AdminAuthController::class,'check'])->name('admin.check');
Route::get('admin_logout', [AdminAuthController::class,'logout']);

Route::get('admin_profile', [AdminAuthController::class,'profile']) ;
Route::get('admin_store', [AdminAuthController::class,'mystore']) ;
Route::get('store_product', [AdminAuthController::class,'store_product']) ;
Route::get('admin_edit', [AdminAuthController::class,'edit'])->middleware('isLoggedAdmin') ;
Route::post('admin_update',[AdminAuthController::class,'update'])->name('admin.update');

Route::domain('{store_name}.' . env('APP_URL'))->group(function () {
    // Route::get('/', function () {
    //     return 'Second subdomain landing page';
    // });
        //admin
        Route::get('/mystore',[StoreController::class,'index'])->middleware('isLoggedAdmin') ;
        Route::get('/mystore/products',[StoreController::class,'products'])->middleware('isLoggedAdmin') ;
        Route::get('/mystore/products/new',[StoreController::class,'new_product'])->middleware('isLoggedAdmin') ;
        Route::post('/mystore/products/create',[ProductController::class,'create'])->name('product.create'); //view path
        Route::get('/mystore/products/search',[ProductController::class,'search']); //view path

        Route::get('/mystore/order',[StoreController::class,'order'])->middleware('isLoggedAdmin');
        Route::get('/order_details/{id}',[StoreController::class,'order_details'])->middleware('isLoggedAdmin');

        Route::post('/mystore/products/store',[ProductController::class,'document_upload'])->name('product.store'); //view path
        Route::post('/mystore/products/storedata', [ProductController::class,'storeData'])->name('product.data');
        Route::post('/mystore/products/storeimgae',[ProductController::class,'storeImage']); //view path
        
        
        //user
        Route::get('/index',[StoreController::class,'userindex']) ;
        Route::get('/cart',[StoreController::class,'cart'])->middleware('isLogged');
        Route::get('/cart/add/{id}',[StoreController::class,'add'])->name('cart.add')->middleware('isLogged');
        Route::get('/cart/checkout',[StoreController::class,'checkout'])->name('cart.checkout')->middleware('isLogged');
        Route::get('/invoice/{id}',[StoreController::class,'invoice'])->name('cart.invoice')->middleware('isLogged');

        Route::get('/cart/destroy/{id}',[StoreController::class,'destroy'])->middleware('isLogged');
        Route::get('/cart/update/{id}',[StoreController::class,'update'])->name('cart.update')->middleware('isLogged');

        Route::get('/product/{id}',[StoreController::class,'product_details']) ;

});

Auth::routes();


// Route::post('add-remove-input-fields',[ProductController::class,'store'])->name('store'); //view path


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


