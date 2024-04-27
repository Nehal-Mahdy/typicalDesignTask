<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', categoryController::class);

// Route::delete('/categories/{id}', 'CategoryController@destroy');
// Route::delete('/categories/{id}', 'CategoryController@destroy');
// Route::get('/categories/{id}',[categoryController::class, 'destroy']);
// Route::get('/categories/all', 'CfController@cfgetData')->name('cf-get-data');