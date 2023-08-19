<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;

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
    return view('layouts.home');
});
// Brand controller 
Route::group(['prefix'=>'brands'],function(){
    Route::get('/view',[BrandController::class,'index'])->name('brands.index');
    Route::post('/store',[BrandController::class,'store'])->name('brands.store');
    Route::post('/update',[BrandController::class,'update'])->name('brands.update');
    Route::get('/delete',[BrandController::class,'destroy'])->name('brands.delete');
});

// Product controller group 
Route::group(['prefix'=>'products'],function(){
    Route::get('/view',[ProductController::class,'index'])->name('products.index');
    Route::get('/edit',[ProductController::class,'edit'])->name('products.edit');
    Route::post('/store',[ProductController::class,'store'])->name('products.store');
    Route::post('/update',[ProductController::class,'update'])->name('products.update');
    Route::get('/delete',[ProductController::class,'destroy'])->name('products.delete');
});
