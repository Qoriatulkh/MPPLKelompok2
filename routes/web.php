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

Route::prefix('/paralegals')->group(function () {
    Route::get('/', 'ParalegalController@index')->name('paralegal.index');
    Route::post('/', 'ParalegalController@store')->name('paralegal.store');
    Route::get('/{paralegal}', 'ParalegalController@show')->name('paralegal.show');
    Route::post('/{paralegal}', 'ParalegalController@update')->name('paralegal.update');
    Route::delete('/{paralegal}', 'ParalegalController@destroy')->name('paralegal.destroy');
});

// Cases
Route::prefix('/cases')->group(function () {
    Route::get('/', 'ParalegalCaseController@index')->name('case.index');
    Route::post('/', 'ParalegalCaseController@store')->name('case.store');
    Route::get('/{case}', 'ParalegalCaseController@show')->name('case.show');
    Route::post('/{case}', 'ParalegalCaseController@update')->name('case.update');
    Route::delete('/{case}', 'ParalegalCaseController@destroy')->name('case.destroy');
});


Route::prefix('/areas')->group(function () {
    Route::get('/', 'AreaController@index')->name('area.index');
    Route::post('/', 'AreaController@store')->name('area.store');
    Route::get('/{area}', 'AreaController@show')->name('area.show');
    Route::post('/{area}', 'AreaController@update')->name('area.update');
    Route::delete('/{area}', 'AreaController@destroy')->name('area.destroy');
});
