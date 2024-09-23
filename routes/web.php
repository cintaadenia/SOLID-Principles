<?php

use App\Http\Controllers\AllNotesController;
use App\Http\Controllers\DetailuserController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function(){

    #Detail User
    Route::resource('detailuser', DetailuserController::class)->except(['show', 'edit', 'create']);

    #All Notes
    Route::get('/allnotes', [AllNotesController::class, 'index'])->name('allnotes.index');

    #Gallery
    Route::resource('gallery', GalleryController::class)->except(['show', 'edit', 'create']);

    #Diary
    Route::resource('diary', DiaryController::class)->except(['show', 'edit', 'create']);

    #Notes
    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
    Route::get('/addnotes', [NotesController::class, 'addnotes'])->name('addnotes');

    #calendar
    Route::get('/calendar', [DiaryController::class, 'calendar'])->name('calendar');

    #calendar
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

//LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


