<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeismicController;
use App\Http\Controllers\DataDownloadController;

Route::get('/', [SeismicController::class, 'index'])->name('data-view');
Route::get('/quality', [SeismicController::class, 'quality'])->name('quality');
Route::get('/time', [SeismicController::class, 'getTime']);
Route::get('/download', [DataDownloadController::class, 'download'])->name('download.data');