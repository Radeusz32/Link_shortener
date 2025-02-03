<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', function () {
    return view('app'); // Bez rozszerzenia .blade.php
});

Route::post('/links', [LinkController::class, 'store']);  // Tworzenie skróconego linku
Route::get('/links', [LinkController::class, 'index']);  // Pobieranie listy linków
Route::get('/{shortCode}', [LinkController::class, 'redirect']);
