<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MasterKategoriQuestController;
use App\Http\Controllers\MasterKategoriRatingController;
use App\Http\Controllers\QuestsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KonsultasiController;

//Authentication
Route::get('/token', function () {
    return csrf_token(); 
});
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Master Data
Route::group(['prefix' => 'kategori-quest'], function () {
    Route::get('/', [MasterKategoriQuestController::class, 'get'])->name('kategori-quest.get');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('/', [MasterKategoriQuestController::class, 'insert'])->name('kategori-quest.insert');
        Route::post('/{encrypted_id}', [MasterKategoriQuestController::class, 'update'])->name('kategori-quest.update');
        Route::delete('/{encrypted_id}', [MasterKategoriQuestController::class, 'destroy'])->name('kategori-quest.destroy');
    });
});

Route::group(['prefix' => 'kategori-rating'], function () {
    Route::get('/', [MasterKategoriRatingController::class, 'get'])->name('kategori-rating.get');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('/', [MasterKategoriRatingController::class, 'insert'])->name('kategori-rating.insert');
        Route::post('/{encrypted_id}', [MasterKategoriRatingController::class, 'update'])->name('kategori-rating.update');
        Route::delete('/{encrypted_id}', [MasterKategoriRatingController::class, 'destroy'])->name('kategori-rating.destroy');
    });
});

//Quests
Route::group(['prefix' => 'quests'], function () {
    Route::get('/', [QuestsController::class, 'get'])->name('quests.get');

    Route::group(['middleware' => ['auth:admin,users']], function () {
        Route::post('/', [QuestsController::class, 'insert'])->name('quests.insert');
        Route::post('/{encrypted_id}', [QuestsController::class, 'update'])->name('quests.update');
        Route::delete('/{encrypted_id}', [QuestsController::class, 'destroy'])->name('quests.destroy');
    });
});

//Users
Route::group(['prefix' => 'user'], function () {
    Route::get('/details', [UserController::class, 'detail'])->name('user.detail');

    Route::group(['middleware' => ['auth:users']], function () {
        Route::post('/favorit-pendengar', [UserController::class, 'favoritPendengar'])->name('user.favorit-pendengar');
        Route::post('/favorit-quest', [UserController::class, 'favoritQuest'])->name('user.favorit-quest');
        Route::post('/rating', [UserController::class, 'rating'])->name('user.rating');
    });
    
    Route::group(['middleware' => ['auth:pendengar']], function () {
        Route::post('/assign-kategori-pendengar', [UserController::class, 'assignKategoriPendengar'])->name('user.assign-kategori-pendengar');
        Route::post('/assign-pekerjaan-pendengar', [UserController::class, 'assignPekerjaanPendengar'])->name('user.assign-pekerjaan-pendengar');
        Route::post('/assign-jadwal-pendengar', [UserController::class, 'assignJadwalPendengar'])->name('user.assign-jadwal-pendengar');
    });
});

//Konsultasi
Route::group(['prefix' => 'konsultasi'], function () {
    Route::get('/list-pendengar', [KonsultasiController::class, 'listPendengar'])->name('konsultasi.list-pendengar');

    Route::group(['middleware' => ['auth:users']], function () {
        Route::post('/pesan', [KonsultasiController::class, 'pesanKonsultasi'])->name('konsultasi.pesan');
        Route::post('/report', [KonsultasiController::class, 'reportKonsultasi'])->name('konsultasi.report');
        Route::get('/riwayat', [KonsultasiController::class, 'riwayatKonsultasi'])->name('konsultasi.riwayat');
    });

    Route::group(['middleware' => ['auth:pendengar']], function () {
        Route::post('/setujui', [KonsultasiController::class, 'setujuiKonsultasi'])->name('konsultasi.setujui');
        Route::post('/tolak', [KonsultasiController::class, 'tolakKonsultasi'])->name('konsultasi.tolak');
    });
});