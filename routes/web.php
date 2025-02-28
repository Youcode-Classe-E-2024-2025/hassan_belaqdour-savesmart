<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyProfileController;
use App\Http\Controllers\TransactionController; // Ajout de l'import pour TransactionController
use Illuminate\Support\Facades\Auth; // Assure-toi que Auth est importé

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Modification de la route /home
Route::get('/home', [FamilyProfileController::class, 'showDashboard'])->name('home')->middleware('auth');


// Ajout des routes pour la sélection du profil
Route::get('/select-profile', [FamilyProfileController::class, 'selectProfile'])->name('select_profile')->middleware('auth');
Route::post('/select-profile', [FamilyProfileController::class, 'storeSelectedProfile'])->name('store_selected_profile')->middleware('auth');

Route::resource('family_profiles', FamilyProfileController::class)->middleware('auth');

// Ajout des routes pour les transactions
Route::resource('transactions', TransactionController::class)->middleware('auth');