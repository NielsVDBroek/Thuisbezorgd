<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactMessageController;
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

Route::get('/', [MenuController::class, 'main'])->name('home.main');
// returns the form for adding a post
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/menu/items', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{post}', [MenuController::class, 'show'])->name('menu.show');
    Route::get('/menu/{item}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{item}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{item}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::get('contact/messages', [ContactMessageController::class, 'index'])->name('contact.contact-messages');
    Route::delete('contact/messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');


});

Route::get('/home', [HomeController::class,'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('contact', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactMessageController::class, 'store'])->name('contact.store');

require __DIR__.'/auth.php';
