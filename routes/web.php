<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;

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
