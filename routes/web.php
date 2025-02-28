<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyProfileController;
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
Route::get('/home', function () {
    $selectedFamilyProfileId = session('selected_family_profile_id');

    if (!$selectedFamilyProfileId) {
        return redirect()->route('select_profile'); // Redirige vers la sélection si aucun profil n'est sélectionné
    }

    try {
        $familyProfile = \App\Models\FamilyProfile::where('user_id', Auth::id())->findOrFail($selectedFamilyProfileId); // Récupère le profil
    } catch (\Exception $e) {
        session()->forget('selected_family_profile_id'); // Supprime l'ID invalide de la session
        return redirect()->route('select_profile')->with('error', 'Le profil sélectionné n\'existe plus.'); // Redirige avec un message d'erreur
    }


    return view('dashboard', compact('familyProfile')); // Passe le profil à la vue
})->name('home')->middleware('auth');


// Ajout des routes pour la sélection du profil
Route::get('/select-profile', [FamilyProfileController::class, 'selectProfile'])->name('select_profile')->middleware('auth');
Route::post('/select-profile', [FamilyProfileController::class, 'storeSelectedProfile'])->name('store_selected_profile')->middleware('auth');

Route::resource('family_profiles', FamilyProfileController::class)->middleware('auth');