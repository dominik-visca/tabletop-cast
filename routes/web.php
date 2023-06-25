<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomAudioController;
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

    Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::post('rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::patch('rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    Route::get('audios/{audio}/edit', [AudioController::class, 'edit'])->name('audios.edit');
    Route::patch('audios/{audio}', [AudioController::class, 'update'])->name('audios.update');
    Route::delete('audios/{audio}', [AudioController::class, 'destroy'])->name('audios.destroy');

    Route::post('/audio/action', [AudioController::class, 'audioAction']);

    Route::get('rooms/{room}/audios/create/{slot}', [RoomAudioController::class, 'create'])->name('audios.create');
    Route::post('rooms/{room}/audios', [RoomAudioController::class, 'store'])->name('audios.store');

    Route::get('campaigns', [CampaignController::class, 'index'])->name('campaigns.index');

});

require __DIR__ . '/auth.php';
