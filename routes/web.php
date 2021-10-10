<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentosController;

Route::get('/', function() {
    return view('layout');
});

Route::get('/create', [DocumentosController::class, 'create'])->name('create');
Route::post('/store', [DocumentosController::class, 'store'])->name('store');
Route::get('/documentos', [DocumentosController::class, 'index'])->name('index');
Route::get('/file/{file}', [DocumentosController::class, 'file'])->name('file');
Route::get('/edit/{id}', [DocumentosController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [DocumentosController::class, 'update'])->name('update');