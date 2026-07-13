<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/',            [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/lokasi',      [PageController::class, 'lokasi'])->name('lokasi');
Route::get('/game',        [PageController::class, 'game'])->name('game');
Route::get('/paparan',     [PageController::class, 'paparan'])->name('paparan');
Route::get('/klasifikasi', [PageController::class, 'klasifikasi'])->name('klasifikasi');
Route::get('/galeri',      [PageController::class, 'galeri'])->name('galeri');
Route::get('/jadwal',      [PageController::class, 'jadwal'])->name('jadwal');
Route::get('/tentang',     [PageController::class, 'tentang'])->name('tentang');
