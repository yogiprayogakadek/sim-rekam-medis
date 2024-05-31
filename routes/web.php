<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Main')->middleware('auth')->group(function() {
    Route::get('/', 'DashboardController@index');
    Route::controller('DashboardController')
        ->prefix('/dashboard')
        ->name('dashboard.')
        ->group(function() {
            Route::get('/', 'index')->name('index');

            // chart
            Route::get('/daily-chart', 'dailyChart')->name('daily.chart');
            Route::post('/filter-chart', 'filterChart')->name('filter.chart');
        });

    Route::controller('RekamMedisController')
        ->prefix('/rekam-medis')
        ->name('rekam-medis.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/history/{id}', 'history')->name('history');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/delete', 'delete')->name('delete');
            Route::post('/filter', 'filter')->name('filter');
            Route::post('/print', 'print')->name('print');
        });

    Route::controller('UserController')
        ->prefix('/user')
        ->name('user.')
        ->middleware(['checkRole:admin'])
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::post('/update-password', 'updatePassword')->name('update.password');
            Route::post('/delete', 'delete')->name('delete');
        });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
