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

    Route::prefix('category')->group(function () {
        Route::get('/', function () {
            return view('admin.layouts.category.index');
        })->name('category');
    });
});