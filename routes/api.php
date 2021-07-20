<?php

use App\Http\Controllers\CovidController;
use Illuminate\Support\Facades\Route;


Route::get('covid/casos/mensais', [CovidController::class, 'index'])->name('covid.index');