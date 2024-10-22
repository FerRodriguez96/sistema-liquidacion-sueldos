<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Estas rutas deberían estar después de instalar Breeze
require __DIR__.'/auth.php';


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/empleados', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('empleados');
Route::get('/empleados/{id}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::get('/empleados/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
