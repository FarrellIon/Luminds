<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MasterKategoriQuestController;

Route::get('/token', function () {
    return csrf_token(); 
});
Route::get('login', [LoginController::class, 'index']);
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