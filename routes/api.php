<?php

use Illuminate\Http\Request;
use App\Car;
use App\Category;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::get('cars', 'API\CarController@index');
    Route::get('car/{id}', 'API\CarController@show');
    Route::post('carRequest', 'API\CarController@car_request');
});
Route::group(['middleware'=>['auth:api','isAdmin']],function (){
    Route::delete('category/{id}', 'API\CategoryController@destroy');
    Route::delete('car/{id}', 'API\CarController@destroy');
    Route::get('Allcars', 'API\CarController@GetAll');
    Route::get('categoriesTable', 'API\CategoryController@index');
    Route::get('rentedCars', 'API\AdminController@getRentedCars');
    Route::get('statistics', 'API\AdminController@statistics');
    Route::get('updateStatus', 'API\AdminController@update_cars_status');
    Route::post('setAvailable', 'API\AdminController@setAvailable');
    Route::post('setUnavailable', 'API\AdminController@setUnavailable');
    Route::post('car', 'API\CarController@store');

});


Route::get('cars', 'API\CarController@index');
Route::get('car/{id}', 'API\CarController@show');




Route::get('qq',function ()
{

    //return Car::select('*')->where('price','=','300')->get();
});
