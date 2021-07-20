<?php

use App\Http\Controllers\CovidController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CovidController::class, 'data'])->name('covid.data');
