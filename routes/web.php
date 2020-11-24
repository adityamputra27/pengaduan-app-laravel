<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function(){
    return view('components.user.index');
});

// Akses Login

Route::prefix('app/')->group(function (){
    Route::get('login', 'LoginController@login_petugas')->name('admin.login');
    Route::get('logout', 'LoginController@logout_petugas')->name('petugas_logout');
    Route::post('first-account', 'RegisterController@verify_register_petugas')->name('admin.first_account');
    Route::post('verify-login', 'LoginController@verify_login_petugas')->name('admin.verify_login');
});

// Akses Umum Setelah Login
// Route::group(['middleware' => ['auth:admin', 'checkRole:admin,petugas']], function(){
//     Route::get('/app', 'Petugas\HomeController@index')->name('admin.index');
// });

Route::group(['middleware' => ['auth:petugas', 'checkRole:admin,petugas']], function(){
    Route::prefix('/app')->namespace('Petugas')->group(function()
    {
        Route::get('/', 'HomeController@index')->name('home_page');

        Route::get('/aduan', 'KelolaAduanController@home')->name('kelola_aduan');
        Route::post('/aduan/{id}/verify', 'KelolaAduanController@verifikasi_aduan')->name('verifikasi_aduan');
        Route::delete('/aduan/{id}/tolak', 'KelolaAduanController@tolak_aduan')->name('tolak_aduan');
        Route::get('/aduan/tolak', 'KelolaAduanController@tampil_tolak_aduan')->name('aduan_tolak');
        Route::post('/aduan/{id}/restore', 'KelolaAduanController@restore_aduan')->name('restore_aduan');
        Route::delete('/aduan/{id}/delete', 'KelolaAduanController@kill_aduan')->name('delete_aduan');
        Route::get('/aduan/{id}/detail', 'KelolaAduanController@detail_aduan')->name('detail_aduan');
        //Route::get('/aduan/{id}/tanggapi', 'KelolaTanggapanController@form_tanggapi')->name('tanggapi_aduan');
        Route::post('/aduan/simpan-tanggapan', 'KelolaTanggapanController@tanggapi')->name('tanggapi_aduan.simpan');
        Route::get('/tanggapan', 'KelolaTanggapanController@index')->name('kelola_tanggapan');
        Route::get('/tanggapan/{id}/isi', 'KelolaTanggapanController@form_tanggapi')->name('tanggapi_aduan');
        Route::post('/tanggapan/{id}/selesai', 'KelolaTanggapanController@selesai_tanggapan')->name('selesai_tanggapan');
        Route::get('/tanggapan/{id}/detail', 'KelolaTanggapanController@detail_tanggapan')->name('detail_tanggapan');

        Route::get('/profile/{id}/edit', 'KelolaAkunController@edit_profile')->name('edit_profile');
        Route::patch('/profile/{id}/edit', 'KelolaAkunController@update_profile')->name('update_profile');

        Route::get('/laporan', 'LaporanController@home')->name('laporan_home');
        Route::post('/laporan/petugas', 'LaporanController@lap_petugas')->name('laporan_petugas');
        Route::post('/laporan/masyarakat', 'LaporanController@lap_masyarakat')->name('laporan_masyarakat');
        Route::post('/laporan/aduan', 'LaporanController@lap_aduan')->name('laporan_aduan');
    });
});

Route::group(['middleware' => ['auth:petugas', 'checkRole:admin']], function(){
    //Auth::routes();
    Route::prefix('/app')->namespace('Petugas')->group(function(){
        Route::prefix('data-masyarakat/')->group(function(){
            Route::get('/', 'KelolaMasyarakatController@index')->name('kelola_masyarakat');
            Route::post('simpan', 'KelolaMasyarakatController@store')->name('simpan_masyarakat');
            Route::patch('{id}/update', 'KelolaMasyarakatController@update_user');
            Route::delete('{id}/delete', 'KelolaMasyarakatController@delete_user')->name('hapus_masyarakat');
        });

        Route::prefix('kategori/')->group(function(){
            Route::get('/', 'KelolaKategoriController@index')->name('kategori');
            Route::post('simpan', 'KelolaKategoriController@store')->name('kategori.simpan');
            Route::get('{id}/edit', 'KelolaKategoriController@apply')->name('kategori.apply');
            Route::patch('{id}/update', 'KelolaKategoriController@update')->name('kategori.update');
            Route::delete('{id}/delete', 'KelolaKategoriController@destroy')->name('kategori.delete');
        });

        Route::get('/petugas', 'KelolaAkunController@index')->name('petugas_home');
        Route::post('/petugas/simpan', 'KelolaAkunController@buat_akun')->name('petugas_simpan');
        Route::patch('/petugas/{id}/update', 'KelolaAkunController@update');
        Route::delete('/petugas/{id}/delete', 'KelolaAkunController@delete_petugas')->name('petugas_delete');

        Route::get('/history-login', 'KelolaAkunController@history_login')->name('history_login');
    });
});

Route::prefix('auth/')->group(function(){
    Route::get('login', 'LoginController@login_masyarakat')->name('user.login');
    Route::get('logout', 'LoginController@logout_masyarakat')->name('masyarakat_logout');
    Route::post('login/verify_login', 'LoginController@verify_login_masyarakat')->name('login_account');
    Route::get('register', 'RegisterController@register_masyarakat')->name('user.register');
    Route::post('register/verify_register', 'RegisterController@verify_register_masyarakat')->name('register_account');
});

Route::group(['middleware' => 'auth:masyarakat'], function(){
    //Auth::routes();
    Route::get('/dashboard', 'AduanController@dashboard')->name('user_dashboard');
    Route::get('/buat-aduan', 'AduanController@form_aduan')->name('user.buat_aduan');
    Route::post('/buat-aduan/simpan', 'AduanController@simpan')->name('user.simpan_aduan');
    Route::get('/auth/{id}/edit', 'AkunController@edit')->name('profile_masyarakat');
    Route::patch('/auth/{id}/update', 'AkunController@update')->name('auth_update');
    Route::get('/dashboard/{id}/download', 'AduanController@download')->name('download');
});