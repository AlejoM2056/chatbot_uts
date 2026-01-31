<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// Página principal
Route::get('/', [HomeController::class, 'index'])->name('chatbot');