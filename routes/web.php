<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ManagerController;
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

    Route::get('teams/', [TeamController::class, 'index'])->name('teams.index');
    Route::get('teams/{id}', [TeamController::class, 'show'])->name('teams.show');
    Route::get('players/', [PlayerController::class, 'index'])->name('players.index');
    Route::get('players/{id}', [PlayerController::class, 'show'])->name('players.show');


    Route::get('manager/create', [ManagerController::class, 'create'])->name('manager.create');
    Route::post('manager', [ManagerController::class, 'store'])->name('manager.store');
    Route::get('manager', [ManagerController::class, 'show'])->name('manager.show');
    Route::get('manager/choose_team', [ManagerController::class, 'choose_team'])->name('manager.choose_team');
    Route::post('manager/assign_team', [ManagerController::class, 'assign_team'])->name('manager.assign_team');
});

require __DIR__.'/auth.php';
