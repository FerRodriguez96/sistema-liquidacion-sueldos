<?php

use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayoutController;
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
    return view('auth.login');
});

// Estas rutas deberían estar después de instalar Breeze
require __DIR__.'/auth.php';


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cargos', [JobTitleController::class, 'index'])->middleware(['auth', 'verified'])->name('cargos.index');
Route::get('/cargos/crear', [JobTitleController::class, 'create'])->middleware(['auth', 'verified'])->name('cargos.create');
Route::post('/cargos', [JobTitleController::class, 'store'])->middleware(['auth', 'verified'])->name('cargos.store');
Route::get('/cargos/{id}/editar', [JobTitleController::class, 'edit'])->middleware(['auth', 'verified'])->name('cargos.edit');
Route::put('/cargos/{id}', [JobTitleController::class, 'update'])->middleware(['auth', 'verified'])->name('cargos.update');


Route::get('/empleados', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('empleados');
Route::get('/empleados/{id}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::get('/empleados/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

//Rutas de liquidaciones
Route::get('/payouts/create/{user}', [PayoutController::class, 'create'])->name('payouts.create');
Route::post('/payouts/store', [PayoutController::class, 'store'])->name('payouts.store');

Route::get('/payouts/{userId}', [PayoutController::class, 'index'])->name('payouts.index');
Route::get('/payouts/{userId}/{payoutId}', [PayoutController::class, 'show'])->name('payouts.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
