<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'items', 'middleware' => ['admin']], function () {
    Route::post('/', [ItemController::class, 'store'])->name('items.store');
    Route::patch('/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
});