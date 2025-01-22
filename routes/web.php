<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    // QRSCAN HANDLE
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/valid', [App\Http\Controllers\AdminController::class, 'validQrScan'])->name('validqr');
    Route::get('/admin/invalid', [App\Http\Controllers\AdminController::class, 'invalidQrScan'])->name('invalidqr');
    Route::get('/admin/buat/titikpoint', [App\Http\Controllers\AdminController::class, 'buatTitikpoint'])->name('buattitikpoint');
    Route::get('/admin/list/titikpoint', [App\Http\Controllers\AdminController::class, 'listTitikpoint'])->name('listtitikpoint');
    Route::post('/admin/cleanup/data/security', [App\Http\Controllers\AdminController::class, 'cleanupQrScan'])->name('cleanupqrscan');
    Route::post('/admin/update/qrscan/{id}', [App\Http\Controllers\Api\SecurityAPI::class, 'updateQrScan'])->name('updateqrscan');
    Route::post('/admin/delete/qrscan/{id}', [App\Http\Controllers\Api\SecurityAPI::class, 'deleteQrScan'])->name('deleteqrscan');
    // TITIKPOINT HANDLE
    Route::delete('/admin/hapus/titikpoint/{kodeunik}', [App\Http\Controllers\AdminController::class, 'hapusTitikpoint'])->name('hapustitikpoint');
    Route::post('/admin/update/titikpoint/{kodeunik}', [App\Http\Controllers\AdminController::class, 'updateTitikpoint'])->name('updatetitikpoint');
    Route::post('/admin/update/security/{id}', [App\Http\Controllers\AdminController::class, 'ubahStatusScan'])->name('ubahstatusscan');
    Route::post('/admin/buat/titikpoint/upload', [App\Http\Controllers\AdminController::class, 'buatTitikpointpost'])->name('buattitikpointpost');
    // LIST SECURITY HANDLE
    Route::get('/admin/security/user', [App\Http\Controllers\AdminController::class, 'listSecurityUser'])->name('listsecurityuser');
    Route::post('/admin/security/user/update/{nik}', [App\Http\Controllers\AdminController::class, 'updateSecurityUser'])->name('updatesecurityuser');
    Route::post('/admin/security/user/add', [App\Http\Controllers\AdminController::class, 'buatSecurityUser'])->name('buatsecurityuser');
});


// API HANDLE

Route::post('/api/security/{kodeunik}', [App\Http\Controllers\Api\SecurityAPI::class, 'check'])->name('checkAPI');
