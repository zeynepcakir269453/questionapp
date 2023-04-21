<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['namespace'=>'front'],function(){
    Route::get('/',[App\Http\Controllers\front\indexController::class, 'index'])->name('index');
    Route::group(['namespace'=>'question','as'=>'question.','prefix'=>'question'],function(){
        Route::get('/create',[App\Http\Controllers\front\question\indexController::class, 'create'])->name('create'); 
        Route::post('/create',[App\Http\Controllers\front\question\indexController::class, 'store'])->name('store'); 

    });
});