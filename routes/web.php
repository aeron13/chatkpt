<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppController;
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


Route::get('/', [AppController::class, 'welcome'])->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard');
    Route::get('/load', [AppController::class, 'load'])->name('load');
    Route::get('/conversation/{id}', [AppController::class, 'conversation'])->middleware('conversation')->name('conversation');
    Route::get('/category/{id}', [AppController::class, 'category'])->name('category');
    Route::group(['prefix' => 'api'], function() {
        Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
        Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');
        Route::middleware('conversation')->group(function() {
            Route::get('/conversations/{id}', [ConversationController::class, 'show'])->name('conversations.show');
            Route::put('/conversations/{id}', [ConversationController::class, 'update'])->name('conversations.update');
        });
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');
    });
});

require __DIR__.'/auth.php';
