<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/service/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::patch('/service/{service}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');

    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::get('/transaction/{transaction}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::patch('/transaction/{transaction}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::patch('/transaction/{transaction}/complete', [TransactionController::class, 'complete'])->name('transaction.complete');
    Route::patch('/transaction/{transaction}/incomplete', [TransactionController::class, 'uncomplete'])->name('transaction.uncomplete');
    Route::delete('/transaction/{transaction}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
    Route::delete('/transaction', [TransactionController::class, 'destroyCompleted'])->name('transaction.deleteallcompleted');

});

require __DIR__.'/auth.php';
