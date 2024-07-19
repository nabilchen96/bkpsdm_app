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


//LOGIN
Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/', 'App\Http\Controllers\AuthController@login');
Route::post('/loginProses', 'App\Http\Controllers\AuthController@loginProses');

//BACKEND
Route::group(['middleware' => 'auth'], function () {

    //DASHBOARD
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

    //USER
    Route::get('/user', 'App\Http\Controllers\UserController@index');
    Route::get('/data-user', 'App\Http\Controllers\UserController@data');
    Route::post('/store-user', 'App\Http\Controllers\UserController@store');
    Route::post('/update-user', 'App\Http\Controllers\UserController@update');
    Route::post('/delete-user', 'App\Http\Controllers\UserController@delete');

    //INSTANSI
    Route::get('/instansi', 'App\Http\Controllers\InstansiController@index');
    Route::get('/data-instansi', 'App\Http\Controllers\InstansiController@data');
    Route::post('/store-instansi', 'App\Http\Controllers\InstansiController@store');

    //PEGAWAI
    Route::get('/pegawai', 'App\Http\Controllers\PegawaiController@index');
    Route::get('/data-pegawai', 'App\Http\Controllers\PegawaiController@data');
    Route::post('/store-pegawai', 'App\Http\Controllers\PegawaiController@store');
    Route::post('/update-pegawai', 'App\Http\Controllers\PegawaiController@update');
    Route::post('/delete-pegawai', 'App\Http\Controllers\PegawaiController@delete');

    //UJIAN DINAS
    Route::get('/ujian-dinas', 'App\Http\Controllers\UjianDinasController@index');
    Route::get('/data-ujian-dinas', 'App\Http\Controllers\UjianDinasController@data');
    Route::post('/store-ujian-dinas', 'App\Http\Controllers\UjianDinasController@store');
    Route::post('/update-ujian-dinas', 'App\Http\Controllers\UjianDinasController@update');
    Route::post('/delete-ujian-dinas', 'App\Http\Controllers\UjianDinasController@delete');
    Route::post('/export-ujian-dinas', 'App\Http\Controllers\UjianDinasController@export');

    //PRAJABATAN
    Route::get('/prajabatan', 'App\Http\Controllers\PrajabatanController@index');
    Route::get('/data-prajabatan', 'App\Http\Controllers\PrajabatanController@data');
    Route::post('/store-prajabatan', 'App\Http\Controllers\PrajabatanController@store');
    Route::post('/update-prajabatan', 'App\Http\Controllers\PrajabatanController@update');
    Route::post('/delete-prajabatan', 'App\Http\Controllers\PrajabatanController@delete');
    Route::post('/export-prajabatan', 'App\Http\Controllers\PrajabatanController@export');

});

//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');