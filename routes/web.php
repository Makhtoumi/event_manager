<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


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
    Route::resource('events', EventController::class);
    Route::post('/events/{id}/join', [EventController::class, 'joinEvent'])->name('events.join');
    Route::post('/events/approve/{participantId}', [EventController::class, 'approveJoinRequest'])->name('events.approve');
    Route::post('/events/reject/{participantId}', [EventController::class, 'rejectJoinRequest'])->name('events.reject');
    Route::get('/events/dashboard', [EventController::class, 'dashboard'])->name('events.dashboard');
    Route::get('/events/{eventId}/show', [EventController::class, 'show'])->name('events.show');


});



Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('events', [EventController::class, 'index'])->name('events.index');

    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');

    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit')->middleware('check.event.ownership:event');
    Route::put('events/{event}', [EventController::class, 'update'])->name('events.update')->middleware('check.event.ownership:event');

    Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy')->middleware('check.event.ownership:event');
});
require __DIR__.'/auth.php';


