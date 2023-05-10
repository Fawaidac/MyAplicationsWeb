<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('berita', [BeritaController::class, 'berita']);
Route::get('surat', [SuratController::class, 'surat']);
Route::post('suratmasuk', [PengajuanController::class, 'suratmasuk']);
Route::post('rekap', [PengajuanController::class, 'rekap']);
Route::post('statussurat', [PengajuanController::class, 'statussurat']);
Route::post('pengajuan', [PengajuanController::class, 'pengajuan']);
Route::post('pembatalan', [PengajuanController::class, 'pembatalan']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('keluarga', [AuthController::class, 'keluarga']);
    Route::get('statusdiajukan', [PengajuanController::class, 'statusdiajukan']);
    Route::get('statusproses', [PengajuanController::class, 'statusproses']);
    Route::get('statusselesai', [PengajuanController::class, 'statusselesai']);
    Route::post('editnohp', [AuthController::class, 'editnohp']);
}); 
