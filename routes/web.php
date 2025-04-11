<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeismicController;
use App\Http\Controllers\DataDownloadController;
use App\Http\Controllers\TimeController;

Route::get('/', [SeismicController::class, 'index'])->name('data-view');
Route::get('/quality', [SeismicController::class, 'quality'])->name('quality');
Route::get('/time', [TimeController::class, 'getTime']);
Route::get('/download', [DataDownloadController::class, 'download'])->name('download.data');