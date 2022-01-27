<?php

use Illuminate\Support\Facades\Route;
use App\Icon;
use App\TypeOfPlace;

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
    Route::resource('/vitalFacilities', 'VitalFacilitiesController', ['except' => ['create', 'show', 'edit']]);
});

Route::get('/iconIndex', 'IconController@index')->withoutMiddleware('auth');

Route::post('register', 'Auth\RegisterController@create');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/map', 'MapController@index')->name('map');

