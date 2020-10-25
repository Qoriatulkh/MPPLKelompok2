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
    return view('welcome');
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

Route::prefix('/cases')->group(function () {
    Route::get('/', 'ParalegalController@index')->name('case.index');
    Route::post('/', 'ParalegalController@store')->name('case.store');
    Route::get('/{case}', 'ParalegalController@show')->name('case.show');
    Route::post('/{case}', 'ParalegalController@update')->name('case.update');
    Route::delete('/{case}', 'ParalegalController@destroy')->name('case.destroy');
});


Route::prefix('/areas')->group(function () {
    Route::get('/', 'ParalegalController@index')->name('area.index');
    Route::post('/', 'ParalegalController@store')->name('area.store');
    Route::get('/{area}', 'ParalegalController@show')->name('area.show');
    Route::post('/{area}', 'ParalegalController@update')->name('area.update');
    Route::delete('/{area}', 'ParalegalController@destroy')->name('area.destroy');
});
