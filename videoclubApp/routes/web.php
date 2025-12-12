<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlquilerController; 
use App\Http\Controllers\ClienteController; 
use App\Http\Controllers\CopiaController; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\PeliculaController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ValoracionController; 

Route::get('/', [MainController::class, 'main'])->name('main');          
Route::get('about', [MainController::class, 'about'])->name('about'); 
Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard'); 

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/edit', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/home', [HomeController::class, 'update'])->name('home.update');

Route::resource('alquiler', AlquilerController::class)->middleware(['auth', 'verified']);
Route::resource('cliente', ClienteController::class)->middleware(['auth', 'verified']);
Route::resource('pelicula', PeliculaController::class);

Route::get('copia', [CopiaController::class, 'index'])->name('copia.index');
Route::get('copia/create', [CopiaController::class, 'create'])->name('copia.create')->middleware(['auth', 'verified']);
Route::post('copia', [CopiaController::class, 'store'])->name('copia.store')->middleware(['auth', 'verified']);
Route::get('copia/{copia}', [CopiaController::class, 'show'])->name('copia.show'); 
Route::get('copia/{copia}/edit', [CopiaController::class, 'edit'])->name('copia.edit')->middleware(['auth', 'verified']);
Route::put('copia/{copia}', [CopiaController::class, 'update'])->name('copia.update')->middleware(['auth', 'verified']);
Route::delete('copia/{copia}', [CopiaController::class, 'destroy'])->name('copia.destroy')->middleware(['auth', 'verified']);

Route::post('valoracion', [ValoracionController::class,'store'])->name('valoracion.store');
Route::get('valoracion/{valoracion}/edit', [ValoracionController::class,'edit'])->name('valoracion.edit');
Route::put('valoracion/{valoracion}', [ValoracionController::class,'update'])->name('valoracion.update');


Auth::routes(['verify'=> true]);