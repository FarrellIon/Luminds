<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MasterKategoriQuestController;
use App\Http\Controllers\MasterKategoriRatingController;

Route::get('/token', function () {
    return csrf_token(); 
});
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

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