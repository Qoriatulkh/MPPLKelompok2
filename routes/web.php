<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});

Auth::routes([
    'verify' => false,
    'reset' => false,
    'confirm' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('/profile')->group(function () {
        Route::get('/', 'ProfileController@profile')->name('profile');
        Route::post('/update', 'ProfileController@updateProfile')->name('profile.update');
        Route::post('/changePassword', 'ProfileController@changePassword')->name('profile.changePassword');
        Route::get('/photo', 'ProfileController@photo')->name('profile.photo');
        Route::post('/photo/upload', 'ProfileController@uploadPhoto')->name('profile.photo.upload');
    });

    Route::prefix('/paralegal')->group(function () {
        Route::get('/', 'ParalegalController@index')->name('paralegal.index');
        Route::get('/create', 'ParalegalController@create')->name('paralegal.create');
        Route::post('/', 'ParalegalController@store')->name('paralegal.store');
        Route::get('/{paralegal}', 'ParalegalController@show')->name('paralegal.show');
        Route::post('/{paralegal}/approve', 'ParalegalController@approve')->name('paralegal.approve');
        Route::post('/{paralegal}/disapprove', 'ParalegalController@disapprove')->name('paralegal.disapprove');
        Route::get('/{paralegal}/edit', 'ParalegalController@edit')->name('paralegal.edit');
        Route::post('/{paralegal}', 'ParalegalController@update')->name('paralegal.update');
        Route::delete('/{paralegal}', 'ParalegalController@destroy')->name('paralegal.destroy');
    });

    // Cases
    Route::prefix('/kasus')->group(function () {
        Route::get('/', 'ParalegalCaseController@index')->name('case.index');
        Route::get('/create', 'ParalegalCaseController@create')->name('case.create');
        Route::post('/store', 'ParalegalCaseController@store')->name('case.store');
        Route::get('/{paralegalCase}/show', 'ParalegalCaseController@show')->name('case.show');
        Route::get('/{paralegalCase}/edit', 'ParalegalCaseController@edit')->name('case.edit');
        Route::post('/{paralegalCase}/update', 'ParalegalCaseController@update')->name('case.update');
        Route::delete('/{paralegalCase}/delete', 'ParalegalCaseController@destroy')->name('case.destroy');

        // Types
        Route::prefix('jenis')->group(function () {
            Route::get('/', 'ParalegalCaseTypeController@index')->name('case.type.index');
            Route::get('/create', 'ParalegalCaseTypeController@create')->name('case.type.create');
            Route::post('/store', 'ParalegalCaseTypeController@store')->name('case.type.store');
            Route::get('/{paralegalCaseType}/show', 'ParalegalCaseTypeController@show')->name('case.type.show');
            Route::get('/{paralegalCaseType}/edit', 'ParalegalCaseTypeController@edit')->name('case.type.edit');
            Route::post('/{paralegalCaseType}/update', 'ParalegalCaseTypeController@update')->name('case.type.update');
            Route::post('/{paralegalCaseType}/delete', 'ParalegalCaseTypeController@destroy')->name('case.type.destroy');
        });

        // Fields
        Route::prefix('bidang')->group(function () {
            Route::get('/', 'ParalegalCaseFieldController@index')->name('case.field.index');
            Route::get('/create', 'ParalegalCaseFieldController@create')->name('case.field.create');
            Route::post('/store', 'ParalegalCaseFieldController@store')->name('case.field.store');
            Route::get('/{paralegalCaseField}/show', 'ParalegalCaseFieldController@show')->name('case.field.show');
            Route::get('/{paralegalCaseField}/edit', 'ParalegalCaseFieldController@edit')->name('case.field.edit');
            Route::post('/{paralegalCaseField}/update', 'ParalegalCaseFieldController@update')->name('case.field.update');
            Route::post('/{paralegalCaseField}/delete', 'ParalegalCaseFieldController@destroy')->name('case.field.destroy');
        });
    });


    Route::prefix('/area')->group(function () {
        Route::get('/', 'AreaController@index')->name('area.index');
        Route::get('/create', 'AreaController@create')->name('area.create');
        Route::post('/', 'AreaController@store')->name('area.store');
        Route::get('/{area}', 'AreaController@show')->name('area.show');
        Route::post('/{area}', 'AreaController@update')->name('area.update');
        Route::delete('/{area}', 'AreaController@destroy')->name('area.destroy');
    });
});
