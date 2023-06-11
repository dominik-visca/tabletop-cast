<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
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

Route::view('/', 'welcome');

Route::middleware('auth', 'verified')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource("rooms", RoomController::class)->only(["index", "store"]);
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name("rooms.show");
    Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::patch('rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');

    Route::post('rooms/{room}/audios', [AudioController::class, 'store'])->name('audios.store');
    Route::get('audios/{audio}/edit', [AudioController::class, 'edit'])->name('audios.edit');
    Route::get('rooms/{room}/audios/create/{slot}', [AudioController::class, 'create'])->name('audios.create');
    Route::patch('audios/{audio}', [AudioController::class, 'update'])->name('audios.update');
    Route::post('/audio/action', [AudioController::class, 'audioAction']);
});

require __DIR__ . '/auth.php';
