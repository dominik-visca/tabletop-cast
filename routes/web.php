<?php

use App\Events\AudioEvent;
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

    #Route::get('/rooms/create', CreateRoom::class)->name('create-room');
});

Route::resource("rooms", RoomController::class)
    ->only(["index", "store"])
    ->middleware(["auth", "verified"]);

Route::get('rooms/{room}', [RoomController::class, 'show'])
    ->middleware('check.room.password')
    ->name("rooms.show");

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::patch('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::post('/rooms/{room}/audios', [AudioController::class, 'store'])->name('audios.store');
    Route::get('/audios/{audio}/edit', [AudioController::class, 'edit'])->name('audios.edit');
    Route::get('/rooms/{room}/audios/create/{slot}', [AudioController::class, 'create'])->name('audios.create');
    Route::patch('/audios/{audio}', [AudioController::class, 'update'])->name('audios.update');
});

Route::get('rooms/{room}/enter', [RoomController::class, 'enter'])->name('rooms.enter');
Route::post('rooms/{room}/enter', [RoomController::class, 'authenticate'])->name('rooms.authenticate');

Route::post('/audio/action', [AudioController::class, 'audioAction']);

Route::get('/test', function () {
    AudioEvent::dispatch("play", 3, 1);

    return "Hello World";
});

require __DIR__ . '/auth.php';
