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


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard/dosen', function () {
    return view('dosen.dashboard');
});


Route::get('/dashboard/umum', function () {
    return view('umum.dashboard');
});


Route::post('/simpanregistrasi', '\App\Http\Controllers\RegisterController@simpanregistrasi')->name('simpanregistrasi');
Route::post('/postlogin','\App\Http\Controllers\RegisterController@postlogin')->name('postlogin');
Route::get('/logout','\App\Http\Controllers\RegisterController@logout')->name('logout');
Route::get('/','\App\Http\Controllers\AdminController@home')->name('home');

Route::group(['middleware' => ['auth','cekrole:Biro 2']],function(){
    Route::get('/dashboard/biro2','\App\Http\Controllers\AdminController@dashboardb2')->name('dashboard.biro2');
    Route::get('/validasipembayaran/biro2/{id}','\App\Http\Controllers\AdminController@peserta_acara_biro2')->name('peserta.acara');
    Route::post('/update_pembayaran/biro2/{id}','\App\Http\Controllers\AdminController@updatepembayaran')->name('validasi.pembayaran');


});  

Route::group(['middleware' => ['auth','cekrole:Biro 4']],function(){
    Route::get('/dashboard/biro4','\App\Http\Controllers\AdminController@index')->name('dashboard.admin');
    Route::get('/peserta/biro4','\App\Http\Controllers\AdminController@peserta')->name('peserta.admin');
    Route::post('/simpanacara','\App\Http\Controllers\AdminController@simpanacara')->name('simpanacara');
    Route::get('/list/acara','\App\Http\Controllers\AdminController@listacara')->name('acara.list');
    Route::get('/manage_acara/biro4','\App\Http\Controllers\AdminController@acara')->name('manage');
    Route::resource('events', AdminController::class);
    Route::get('/manage_peserta/biro4/{id}','\App\Http\Controllers\AdminController@peserta_acara')->name('manage.peserta');
    Route::post('/update_peserta/biro4/{id}','\App\Http\Controllers\AdminController@validasipendaftaran')->name('validasi.peserta');
});

Route::group(['middleware' => ['auth','cekrole:Mahasiswa']],function(){
    Route::get('/dashboard/mhs','\App\Http\Controllers\MahasiswaController@index')->name('dashboard.mahasiswa');
    Route::get('/list/acara/mhs','\App\Http\Controllers\MahasiswaController@listacara')->name('acara.list.mhs');
    Route::get('/form_daftar_acara/mhs/{id}', '\App\Http\Controllers\MahasiswaController@formdaftaracara')->name('daftaracara');
    Route::post('/simpandaftaracara/mhs/{id}', '\App\Http\Controllers\MahasiswaController@simpandaftar')->name('simpandaftar');
    Route::get('/daftar_acara/mhs','\App\Http\Controllers\MahasiswaController@daftaracara')->name('daftaracara.mahasiswa');
    Route::post('/bayar/mhs/{id}', '\App\Http\Controllers\MahasiswaController@pembayaran')->name('pembayaran');

});
