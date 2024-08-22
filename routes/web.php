<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\TaskCreate;
use App\Livewire\TaskEdit;
use App\Livewire\TaskDashboard;
use App\Http\Controllers\TaskController;

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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', TaskDashboard::class)->name('dashboard');
    Route::resource('tasks', TaskController::class)->except('index');
});

require __DIR__ . '/auth.php';
