<?php

namespace App\Http\Controllers;

use App\Models\FamilyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FamilyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familyProfiles = FamilyProfile::where('user_id', Auth::id())->get(); // Récupère les profils de l'utilisateur connecté
        return view('family_profiles.index', compact('familyProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('family_profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
        ]);

        $data = $request->except('profile_image');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('public/family_profiles');
            $data['profile_image'] = Storage::url($imagePath); // Enregistre le chemin vers l'image
        }

        FamilyProfile::create($data);

        return redirect()->route('family_profiles.index')->with('success', 'Profil familial ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Empêche l'accès aux profils des autres utilisateurs
        }
        return view('family_profiles.show', compact('familyProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Empêche l'accès aux profils des autres utilisateurs
        }
        return view('family_profiles.edit', compact('familyProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Empêche l'accès aux profils des autres utilisateurs
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
        ]);

        $data = $request->except('profile_image');

        if ($request->hasFile('profile_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($familyProfile->profile_image) {
                Storage::delete(str_replace('/storage', 'public', $familyProfile->profile_image));
            }
            $imagePath = $request->file('profile_image')->store('public/family_profiles');
            $data['profile_image'] = Storage::url($imagePath); // Enregistre le chemin vers l'image
        }

        $familyProfile->update($data);

        return redirect()->route('family_profiles.index')->with('success', 'Profil familial mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Empêche l'accès aux profils des autres utilisateurs
        }

        // Supprimer l'image si elle existe
        if ($familyProfile->profile_image) {
            Storage::delete(str_replace('/storage', 'public', $familyProfile->profile_image));
        }

        $familyProfile->delete();

        return redirect()->route('family_profiles.index')->with('success', 'Profil familial supprimé avec succès.');
    }
}