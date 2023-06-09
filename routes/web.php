<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_kepuharjo;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\data_usercontroller;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [controller_kepuharjo::class, 'index'])->name('index');
Route::get('/login', [controller_kepuharjo::class, 'login'])->name('login');
Route::post('/loginauth', [controller_kepuharjo::class, 'loginauth'])->name('loginauth');
Route::get('/dashboard', [controller_kepuharjo::class, 'dashboard'])->name('dashboard');
Route::post('/postlogin',[controller_kepuharjo::class, 'customLogin'])->name('postlogin');


Route::get('/suratmasuk', [controller_kepuharjo::class, 'suratmasuk'])->name('suratmasuk');
Route::get('/suratditolak', [controller_kepuharjo::class, 'suratditolak'])->name('suratditolak');
Route::get('/suratselesai', [controller_kepuharjo::class, 'suratselesai'])->name('suratselesai');

Route::get('/masteruser', [controller_kepuharjo::class, 'masteruser'])->name('masteruser');
Route::get('/masterrtrw', [controller_kepuharjo::class, 'master_rtrw'])->name('masterrtrw');
Route::get('/mastersurat', [controller_kepuharjo::class, 'master_surat']);

Route::get('/masterkk', [controller_kepuharjo::class, 'master_kk'])->name('masterkk');
Route::get('/masterkkmas/{id}', [controller_kepuharjo::class, 'master_kk_mas']);

Route::get('/berita', [controller_kepuharjo::class, 'berita'])->name('berita');
Route::get('/tentang', [controller_kepuharjo::class, 'tentang'])->name('tentang');

Route::get('/buttons', [controller_kepuharjo::class, 'buttons'])->name('buttons');

Route::post('/simpankk',[controller_kepuharjo::class, 'simpanmasterkk'])->name('simpankk');
Route::post('/simpanrtrw',[controller_kepuharjo::class, 'simpanmasterrtrw'])->name('simpanrtrw');
Route::post('/simpanuser',[controller_kepuharjo::class, 'simpanmasteruser'])->name('simpanuser');
// Route::post('/simpanuserakun/{id}',[controller_kepuharjo::class, 'simpanmasteruserakun']);
// Route::post('/simpanuserakuns/{id}',[controller_kepuharjo::class, 'simpanmasteruserakun
Route::post('/simpanuserakuns/{id}', 'controller_kepuharjo@simpanmasteruserakun');
Route::get('simpanakuns/{id}', [controller_kepuharjo::class, 'simpanmasteruserakun']);
Route::post('/simpanberita',[controller_kepuharjo::class, 'simpanmasterberita'])->name('simpanberita');
Route::post('/simpansurat',[controller_kepuharjo::class, 'simpan_surat'])->name('simpansurat');

Route::get('/masterrt/{id}', [controller_kepuharjo::class, 'master_rt'])->name('masterrt');
Route::post('/simpanrt',[controller_kepuharjo::class, 'simpanmasterrt'])->name('simpanrt');
Route::get('{id}/hapus-masterrt', [controller_kepuharjo::class, 'hapusmasterrt']);
Route::post('update-masterrt/{id}', [controller_kepuharjo::class, 'updatemasterrt']);

Route::get('{id}/hapus-masterkk', [controller_kepuharjo::class, 'hapus']);
Route::post('update-masterkk/{id}', [controller_kepuharjo::class, 'update']);

Route::get('hapus-berita/{id}', [controller_kepuharjo::class, 'hapusberita']);
Route::post('update-berita/{id}', [controller_kepuharjo::class, 'updateberita']);

Route::get('{id}/hapus-masterrtrw', [controller_kepuharjo::class, 'hapusmasterrtrw']);
Route::post('update-masterrtrw/{id}', [controller_kepuharjo::class, 'updatemasterrtrw']);

Route::get('{id}/hapus-masteruser', [controller_kepuharjo::class, 'hapusmasteruser']);
Route::post('update-masteruser/{id}', [controller_kepuharjo::class, 'updatemasteruser']);

Route::get('/ajax', [controller_kepuharjo::class, 'ajax']);
Route::get('/ajaxmasyarakat', [controller_kepuharjo::class, 'ajax_masyarakat']);
Route::get('/read', [controller_kepuharjo::class, 'read']);

// Route::get('/login', [AuthController::class, 'showLoginForm']);
// Route::post('/login',[AuthController::class, 'login']);