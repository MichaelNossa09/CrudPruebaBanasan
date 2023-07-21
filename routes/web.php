<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/home');
Route::get('/home', [PublicacionController::class, 'index'])->name('home.index');
Route::post('/home', [UserController::class, 'store'])->name('home.store');

Route::post('/login', [AuthLoginController::class, 'login'])->name('login.login');

Route::middleware('auth.custom')->group(function () {
    Route::get('/submit', [PublicacionController::class, 'show'])->name('publicacion.show');
    Route::post('/submit', [PublicacionController::class, 'store'])->name('publicacion.store');

    Route::get('/publicaciones/{publicacion}/edit', [PublicacionController::class, 'edit'])->name('publicaciones.edit');
    Route::put('/publicaciones/{publicacion}', [PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/publicaciones/{id}/delete', [PublicacionController::class, 'delete'])->name('publicaciones.delete');

    Route::get('/profile', [PublicacionController::class, 'publicacionesUsuarioLogeado'])->name('publicacion.user');

    Route::post('/vote', [VoteController::class, 'votar'])->name('vote.votar');

    Route::get('/logout', [AuthLoginController::class, 'logout'])->name('login.logout');
});
