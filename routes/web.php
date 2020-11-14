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


Route::post('/proses_login_pemilih', 'App\Http\Controllers\LoginController@login')->name('proses_login_pemilih');

Route::group(['middleware' => 'guest'], function () {
	Route::get('/', function () {
		return view('welcome');
	})->name('login_pemilih');
	Route::get('/login');
});

Route::group(['middleware' => 'pemilih'], function () {
	Route::get('/home', 'App\Http\Controllers\PemilihController@index')->name('home');
});

Route::group(['middleware' => 'admin'], function (){
	
	Route::get('/dashboard', 'App\Http\Controllers\AdminController@index')->name('dashboard');
	Route::post('/import_siswa', 'App\Http\Controllers\AdminController@import_siswa')->name('import_siswa');

	Route::group(['prefix' => 'admin'], function () {
		// Buat Pemilihan
		Route::get('/pemilihan', 'App\Http\Controllers\PemilihanController@index')->name('admin_pemilihan');
		Route::post('/input_pemilihan', 'App\Http\Controllers\PemilihanController@input_pemilihan')->name('admin_input_pemilihan');
		Route::post('/update_pemilihan', 'App\Http\Controllers\PemilihanController@update_pemilihan')->name('admin_update_pemilihan');
		Route::post('/hapus_pemilihan', 'App\Http\Controllers\PemilihanController@hapus_pemilihan')->name('admin_hapus_pemilihan');
		// Akhir Buat Pemilihan


		// Buat Calon
		Route::get('/calon', 'App\Http\Controllers\CalonController@index')->name('admin_calon');
		Route::post('/input_calon', 'App\Http\Controllers\CalonController@input_calon')->name('admin_input_calon');
		Route::post('/update_calon', 'App\Http\Controllers\CalonController@update_calon')->name('admin_update_calon');
		Route::post('/hapus_calon', 'App\Http\Controllers\CalonController@hapus_calon')->name('admin_hapus_calon');
		// Akhir Buat Calon
	});
});


Auth::routes();


