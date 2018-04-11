<?php

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
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.layouts.dashboard.index');
    })->name('dashboard');

    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories');
        Route::get('/edit/{catid}', 'CategoryController@edit')->name('edit_category');
        Route::get('/edit/0', 'CategoryController@edit')->name('new_category');
        Route::post('save', 'CategoryController@save')->name('save_category');
        Route::get('/delete/{catid}', 'CategoryController@delete')->name('delete_category');
    });

    //media library routes
    Route::prefix('media')->group(function () {
        Route::get('/', 'MediaController@index');
    });
});