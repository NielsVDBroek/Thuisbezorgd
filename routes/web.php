<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index'])->name('menu.index');

Route::get('/menu/create', MenuController::class . '@create')->name('menu.create');

Route::post('/menu', MenuController::class .'@store')->name('menu.store');

Route::get('/menu/{item}', MenuController::class .'@show')->name('menu.show');

Route::get('/menu/{item}/edit', MenuController::class .'@edit')->name('menu.edit');

Route::put('/menu/{item}', MenuController::class .'@update')->name('menu.update');

Route::delete('/menu/{item}', MenuController::class .'@destroy')->name('menu.destroy');