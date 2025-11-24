<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TablaController;

Route::get('/', [TablaController::class, 'tabla'])->name('tabla.template');