<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\TypeOfPlace;
use App\VitalFacility;

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

Auth::routes();
Route::group(['prefix' => 'api'], function() {
    Route::resource('/typeOfPlace', 'TypeOfPlaceController', ['except' => ['create', 'show', 'edit']]);
    Route::resource('/vitalFacility', 'VitalFacilityController', ['except' => ['create', 'show', 'edit']]);
});

Route::get('/typeOfPlaceIndex', 'TypeOfPlaceController@index')->withoutMiddleware('auth');
Route::get('/vitalFacilityIndex', 'VitalFacilityController@index')->withoutMiddleware('auth');

Route::post('register', 'Auth\RegisterController@create');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/map', 'MapController@index')->name('map');

