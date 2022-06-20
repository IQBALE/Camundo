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


Route::get('/login', 'App\Http\Controllers\Controller@login')->middleware("guest");
Route::get('/logout', 'App\Http\Controllers\Controller@logout' );
Route::post('/loginAct',  'App\Http\Controllers\Controller@login_act');

Route::get('/test', 'App\Http\Controllers\Controller@test');

Route::group(['middleware' => ['login']], function(){
    // view
    Route::get('/', 'App\Http\Controllers\Controller@home');
    Route::get('/formulir/{id}', 'App\Http\Controllers\Controller@formulir');
    Route::get('/approval/{id}', 'App\Http\Controllers\Controller@approval');

    // act
    Route::post('/daftarAct', 'App\Http\Controllers\Controller@daftar_act');
    Route::post('/approvalAct', 'App\Http\Controllers\Controller@approval_act');
    Route::post('/formulirAct', 'App\Http\Controllers\Controller@formulir_act');
});