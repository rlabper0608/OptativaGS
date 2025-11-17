<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PintorController;
use App\Http\Controllers\PinturaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('pintor', [PintorController::class,'index'])->name('pintor.index');
Route::get('pintor/create', [PintorController::class,'create'])->name('pintor.create');
Route::post('pintor', [PintorController::class,'store'])->name('pintor.store');
Route::get('pintor/{pintor}', [PintorController::class,'show'])->name('pintor.show');
Route::get('pintor/{pintor}/edit', [PintorController::class,'edit'])->name('pintor.edit');
Route::put('pintor/{pintor}', [PintorController::class,'update'])->name('pintor.update');
Route::delete('pintor/{pintor}', [PintorController::class,'destroy'])->name('pintor.destroy');

Route::get('pintura/create', [PinturaController::class,'create'])->name('pintura.create');
Route::get('pintura', [PinturaController::class,'index'])->name('pintura.index');