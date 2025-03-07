<?php
namespace App\Http\Controllers;

use App\Models\FamilyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Transaction;

class FamilyProfileController extends Controller
{
    public function index()
    {
        $familyProfiles = FamilyProfile::where('user_id', Auth::id())->get();
        return view('family_profiles.index', compact('familyProfiles'));
    }

    public function create()
    {
        return view('family_profiles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('profile_image');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('public/family_profiles');
            $data['profile_image'] = Storage::url($imagePath);
        }

        FamilyProfile::create($data);
        return redirect()->route('family_profiles.index')->with('success', 'Profil familial ajouté avec succès.');
    }

    public function show(FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('family_profiles.show', compact('familyProfile'));
    }

    public function edit(FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('family_profiles.edit', compact('familyProfile'));
    }

    public function update(Request $request, FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('profile_image');

        if ($request->hasFile('profile_image')) {
            if ($familyProfile->profile_image) {
                Storage::delete(str_replace('/storage', 'public', $familyProfile->profile_image));
            }
            $imagePath = $request->file('profile_image')->store('public/family_profiles');
            $data['profile_image'] = Storage::url($imagePath);
        }

        $familyProfile->update($data);
        return redirect()->route('family_profiles.index')->with('success', 'Profil familial mis à jour avec succès.');
    }

    public function destroy(FamilyProfile $familyProfile)
    {
        if ($familyProfile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($familyProfile->profile_image) {
            Storage::delete(str_replace('/storage', 'public', $familyProfile->profile_image));
        }

        $familyProfile->delete();
        return redirect()->route('family_profiles.index')->with('success', 'Profil familial supprimé avec succès.');
    }

    public function selectProfile()
    {
        $familyProfiles = FamilyProfile::where('user_id', Auth::id())->get();

        if ($familyProfiles->count() <= 1) {
            if ($familyProfiles->isNotEmpty()) {
                session(['selected_family_profile_id' => $familyProfiles->first()->id]);
            } else {
                session()->forget('selected_family_profile_id');
            }
            return redirect()->route('home');
        }

        return view('family_profiles.select', compact('familyProfiles'));
    }

    public function storeSelectedProfile(Request $request)
    {
        $request->validate([
            'family_profile_id' => 'required|exists:family_profiles,id,user_id,' . Auth::id(),
        ]);

        session(['selected_family_profile_id' => $request->family_profile_id]);
        return redirect()->route('home');
    }

    public function showDashboard()
    {
        // Récupérer l'ID du profil de famille sélectionné dans la session
        $selectedFamilyProfileId = session('selected_family_profile_id');
        $familyProfile = null;

        // Si un profil de famille est sélectionné
        if ($selectedFamilyProfileId) {
            try {
                // Récupérer le profil de famille de l'utilisateur authentifié
                $familyProfile = FamilyProfile::where('user_id', Auth::id())->findOrFail($selectedFamilyProfileId);
            } catch (\Exception $e) {
                // Si une erreur survient, supprimer l'ID du profil de famille de la session
                session()->forget('selected_family_profile_id');
                $familyProfile = null;
            }
        }

        // Récupérer toutes les catégories
        $categories = Category::all();

        // Récupérer toutes les transactions
        $transactions = Transaction::all();


        // Passer les données à la vue
        return view('dashboard', compact('familyProfile', 'categories', 'transactions'));
    }

}
