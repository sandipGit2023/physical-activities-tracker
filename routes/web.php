<?php

use App\Http\Controllers\LeaderboardController;
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
    return redirect()->route('leaderboard');
});

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
Route::post('/leaderboard/recalculate', [LeaderboardController::class, 'recalculate'])->name('leaderboard.recalculate');
