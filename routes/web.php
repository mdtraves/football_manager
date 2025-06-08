<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Models\Team;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $teams = Team::all();
     $teams = Team::orderBy('overall_rating', 'desc')->get();

    return view('dashboard', ['teams' => $teams]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('teams/{id}', [TeamController::class, 'show'])->name('teams.show');
});

require __DIR__.'/auth.php';
