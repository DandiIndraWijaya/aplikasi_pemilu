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

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Auth::routes();



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Route::get('/dashboard', 'App\Http\Controllers\AdminController@index')->name('dashboard');
Route::post('/import_siswa', 'App\Http\Controllers\AdminController@import_siswa')->name('import_siswa');

Route::get('/admin/calon', 'App\Http\Controllers\CalonController@index')->name('admin_calon');
Route::get('/admin/pemilihan', 'App\Http\Controllers\PemilihanController@index')->name('admin_pemilihan');
Route::post('/admin/input_pemilihan', 'App\Http\Controllers\PemilihanController@input_pemilihan')->name('admin_input_pemilihan');

Route::post('/admin/update_pemilihan', 'App\Http\Controllers\PemilihanController@update_pemilihan')->name('admin_update_pemilihan');

Route::post('/admin/hapus_pemilihan', 'App\Http\Controllers\PemilihanController@hapus_pemilihan')->name('admin_hapus_pemilihan');