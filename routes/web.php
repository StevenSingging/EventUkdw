<?php

use App\Http\Controllers\AdminController;
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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/master', function () {
    return view('template.master');
});

Route::get('/dashboard/biro', function () {
    return view('biro.dashboard');
});

Route::get('/dashboard/dosen', function () {
    return view('dosen.dashboard');
});

Route::get('/dashboard/mahasiswa', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/dashboard/umum', function () {
    return view('umum.dashboard');
});

Route::get('/dashboard/admin', function () {
    return view('admin.dashboard');
});

Route::post('/simpanregistrasi', '\App\Http\Controllers\RegisterController@simpanregistrasi')->name('simpanregistrasi');
Route::post('/postlogin','\App\Http\Controllers\RegisterController@postlogin')->name('postlogin');
Route::get('/logout','\App\Http\Controllers\RegisterController@logout')->name('logout');

Route::post('/simpanacara','\App\Http\Controllers\AdminController@simpanacara')->name('simpanacara');
Route::get('/list/acara','\App\Http\Controllers\AdminController@listacara')->name('acara.list');
Route::get('/manage_acara/admin','\App\Http\Controllers\AdminController@index')->name('manage');
Route::resource('events', AdminController::class);
Route::post('/edit-event', '\App\Http\Controllers\AdminController@editEvent')->name('calendar.editEvent');


