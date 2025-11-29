<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\VolunteerDashboardController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/signup', [SignupController::class, 'store']);

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/volunteer-form', function () {
    return view('volunteer-form');
});

Route::post('/volunteer-register', [VolunteerController::class, 'store']);
 
Route::get('/volunteer/{id}/dashboard', [VolunteerDashboardController::class, 'show'])->name('volunteer.dashboard');
Route::put('/volunteer/{id}/update', [VolunteerDashboardController::class, 'update'])->name('volunteer.update');
Route::delete('/volunteer/{id}/delete', [VolunteerDashboardController::class, 'delete'])->name('volunteer.delete');

// API vote endpoint
Route::post('/api/polls/{poll}/vote', [PollController::class, 'vote']);

// Poll management routes
Route::get('/polls/create', [PollManagementController::class, 'create']);
Route::post('/polls/create', [PollManagementController::class, 'store']);
Route::get('/polls/manage', [PollManagementController::class, 'index']);
Route::delete('/polls/{poll}/delete', [PollManagementController::class, 'destroy']);

Route::get('/login', function () {
    return view('login');
});