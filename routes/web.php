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
    if (session('akses')=='admin') {
        return redirect('/home');
    }elseif (session('akses')=='guru') {
        return redirect('/home-guru');
    }elseif (session('akses')=='siswa') {
        return redirect('/home-siswa');
    }else {
        return view('auth.login');
    }
    
});
// Auth::routes();
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login2', 'AuthController@postlogin')->name('login2');
Route::get('/logout', 'AuthController@logout')->name('logout')->middleware('auth');

Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home-guru', 'HomeController@guru')->name('home.guru');
    Route::get('/home-siswa', 'HomeController@siswa')->name('home.siswa');

    Route::resource('siswa', 'SiswaController');
    Route::post('/siswa/gantipass', 'SiswaController@gantiPass')->name('siswa.gantipass');

    Route::resource('/guru','GuruController');
    Route::post('/guru/gantipass', 'GuruController@gantiPass')->name('guru.gantipass');

    Route::resource('/kelas','KelasController');

    Route::resource('/literasi-siswa','LiterasiSiswaController');
    Route::resource('/literasi-admin','LiterasiAdminController');
    Route::get('/literasiToday-admin','LiterasiAdminController@today')->name('literasi.today');
    Route::resource('/literasi-guru','LiterasiGuruController');

    Route::get('/profile-guru/{id}','ProfileController@guru')->name('guru.profile');
    Route::post('/profile-guru','ProfileController@updateGuru')->name('guru.profileUpdate');
    Route::post('/password-guru','ProfileController@passGuru')->name('guru.password');
    Route::post('/foto-guru','ProfileController@fotoGuru')->name('guru.foto');

    Route::get('/profile-siswa/{id}','ProfileController@siswa')->name('siswa.profile');
    Route::post('/profile-siswa','ProfileController@updateSiswa')->name('siswa.profileUpdate');
    Route::post('/password-siswa','ProfileController@passSiswa')->name('siswa.password');
    Route::post('/foto-siswa','ProfileController@fotoSiswa')->name('siswa.foto');
});

