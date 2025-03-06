<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SavingGoalController;
use App\Http\Controllers\CategoryController; // Ajout de l'import pour CategoryController
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [FamilyProfileController::class, 'showDashboard'])->name('home')->middleware('auth');

Route::get('/select-profile', [FamilyProfileController::class, 'selectProfile'])->name('select_profile')->middleware('auth');
Route::post('/select-profile', [FamilyProfileController::class, 'storeSelectedProfile'])->name('store_selected_profile')->middleware('auth');

Route::resource('family_profiles', FamilyProfileController::class)->middleware('auth');

Route::resource('transactions', TransactionController::class)->middleware('auth');

// Ajout des routes pour les catégories
Route::resource('categories', CategoryController::class)->middleware('auth');

Route::resource('saving_goals', SavingGoalController::class)->middleware('auth');

use App\Http\Controllers\UserController;

Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update')->middleware('auth');