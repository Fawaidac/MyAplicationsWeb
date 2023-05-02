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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('keluarga', [AuthController::class, 'keluarga']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('berita', [BeritaController::class, 'berita']);
Route::get('surat', [SuratController::class, 'surat']);
Route::post('suratmasuk', [PengajuanController::class, 'suratmasuk']);
Route::post('rekap', [PengajuanController::class, 'rekap']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
