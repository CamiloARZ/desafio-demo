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

Route::get('/', 'ParameterController@index')->name('parameter.index');

// Parameter 
    Route::delete('parameter/delete', 'ParameterController@parameterDestroy')->name('parameter.delete');
    Route::post('parameter/store', 'ParameterController@store')->name('parameter.store');
    Route::get('parameter/edit', 'ParameterController@edit')->name('parameter.edit');
    Route::post('parameter/store', 'ParameterController@store')->name('parameter.store');