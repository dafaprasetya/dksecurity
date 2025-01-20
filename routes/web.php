<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/buat/titikpoint', [App\Http\Controllers\AdminController::class, 'buatTitikpoint'])->name('buattitikpoint');
    Route::get('/admin/list/titikpoint', [App\Http\Controllers\AdminController::class, 'listTitikpoint'])->name('listtitikpoint');
    Route::delete('/admin/hapus/titikpoint/{kodeunik}', [App\Http\Controllers\AdminController::class, 'hapusTitikpoint'])->name('hapustitikpoint');
    Route::post('/admin/update/titikpoint/{kodeunik}', [App\Http\Controllers\AdminController::class, 'updateTitikpoint'])->name('updatetitikpoint');
    Route::post('/admin/update/security/{id}', [App\Http\Controllers\AdminController::class, 'ubahStatusScan'])->name('ubahstatusscan');
    Route::post('/admin/buat/titikpoint/upload', [App\Http\Controllers\AdminController::class, 'buatTitikpointpost'])->name('buattitikpointpost');
});


// API HANDLE

Route::post('/api/security/{kodeunik}', [App\Http\Controllers\Api\SecurityAPI::class, 'check'])->name('checkAPI');
