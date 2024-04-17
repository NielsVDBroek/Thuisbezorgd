<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', MenuController::class .'@index')->name('menu.index');
// returns the form for adding a post
Route::get('/posts/create', MenuController::class . '@create')->name('menu.create');
// adds a post to the database
Route::post('/posts', MenuController::class .'@store')->name('menu.store');
// returns a page that shows a full post
Route::get('/posts/{post}', MenuController::class .'@show')->name('menu.show');
// returns the form for editing a post
Route::get('/posts/{post}/edit', MenuController::class .'@edit')->name('menu.edit');
// updates a post
Route::put('/posts/{post}', MenuController::class .'@update')->name('menu.update');
// deletes a post
Route::delete('/posts/{post}', MenuController::class .'@destroy')->name('menu.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
