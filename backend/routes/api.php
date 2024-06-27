<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'items', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [LoginController::class, 'test'])->name('items.test');
    Route::patch('/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
});