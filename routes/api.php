<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Anggota;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\Api\PengembalianController;

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

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('anggota')->group(function () {
    Route::get('/', [Anggota::class, 'index']);
    Route::post('/', [Anggota::class, 'store']);
    Route::get('/{id}', [Anggota::class, 'show']);
    Route::put('/{id}', [Anggota::class, 'update']);
    Route::delete('/{id}', [Anggota::class, 'destroy']);
});

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangApiController::class, 'index']);
    Route::get('/create-kode', [BarangApiController::class, 'createKode']); // untuk generate kode otomatis
    Route::post('/', [BarangApiController::class, 'store']);
    Route::get('/{id}', [BarangApiController::class, 'show']);
    Route::put('/{id}', [BarangApiController::class, 'update']);
    Route::delete('/{id}', [BarangApiController::class, 'destroy']);
});
// Peminjaman API Routes
Route::prefix('peminjaman')->group(function () {
    Route::get('/', [PeminjamanController::class, 'index']);               // List semua peminjaman
    Route::post('/', [PeminjamanController::class, 'store']);              // Simpan data peminjaman baru
    Route::get('/{code}', [PeminjamanController::class, 'show']);          // Detail satu peminjaman (berdasarkan kode)
    Route::put('/{code}', [PeminjamanController::class, 'update']);        // Update peminjaman berdasarkan kode
    Route::delete('/{id}', [PeminjamanController::class, 'destroy']);      // Hapus peminjaman (berdasarkan ID)
});

Route::prefix('pengembalian')->group(function () {
    Route::get('/', [PengembalianController::class, 'index']);               
    Route::post('/', [PengembalianController::class, 'store']);              
    Route::get('/{code}', [PengembalianController::class, 'show']);         
    Route::put('/{code}', [PengembalianController::class, 'update']);        
    Route::delete('/{id}', [PengembalianController::class, 'destroy']);      
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
