<?php

use App\Http\Controllers\DetailuserController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function(){

    #Detail User
    Route::resource('detailuser', DetailuserController::class)->except(['show', 'edit', 'create']);

    #Gallery
    Route::resource('gallery', GalleryController::class)->except(['show', 'edit', 'create']);

    #Diary
    Route::resource('diary', DiaryController::class)->except(['show', 'edit', 'create']);

    #calendar
    Route::get('/calendar', [DiaryController::class, 'calendar'])->name('calendar');

    #favorit
    Route::resource('favorite', FavoriteController::class);

    #trash
    Route::resource('trash', TrashController::class);
    Route::patch('/restore/{id}', [TrashController::class, 'restore'])->name('restore');
    Route::delete('/force-delete/{id}', [TrashController::class, 'forceDelete'])->name('forceDelete');


});

# LOGIN REGISTER
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/log', [LoginController::class, 'login'])->name('login.store');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/regist', [RegisterController::class, 'store'])->name('register.store');

#LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


