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
    Route::get('/{id}/{selflink}',[App\Http\Controllers\front\indexController::class, 'view'])->name('view');

    Route::group(['namespace'=>'comments','as'=>'comment.','prefix'=>'comment'],function(){
        Route::post('/store/{id}',[App\Http\Controllers\front\comment\indexController::class, 'store'])->name('store'); 
        Route::get('/like/{id}',[App\Http\Controllers\front\comment\indexController::class, 'likeordislike'])->name('likeordislike'); 
        Route::get('/delete/{id}',[App\Http\Controllers\front\comment\indexController::class, 'delete'])->name('delete'); 
        Route::get('/correct/{id}',[App\Http\Controllers\front\comment\indexController::class, 'correct'])->name('correct'); 

    });

    Route::group(['namespace'=>'category','as'=>'category.','prefix'=>'category'],function(){
        Route::get('/{selflink}',[App\Http\Controllers\front\category\indexController::class, 'index'])->name('index'); 
    });

    Route::group(['namespace'=>'settings','as'=>'settings.','prefix'=>'settings'],function(){
        Route::get('/',[App\Http\Controllers\front\settings\indexController::class, 'index'])->name('index'); 
    });
    
    Route::get('/{id}/{selflink}',[App\Http\Controllers\front\indexController::class, 'view'])->name('view')->middleware(['VisitorUser']);

});