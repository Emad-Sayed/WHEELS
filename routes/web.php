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
Route::get('/test', function () {
    $start=new \Carbon\Carbon();
    $end=new \Carbon\Carbon();
    $end->addDays(4);
    $rented=new \App\rentedCar();
    return $start;
});
Route::get('testa', 'API\AdminController@update_cars_status');
