<?php

namespace App\Http\Controllers;

use App\Models\SavingGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savingGoals = SavingGoal::where('user_id', Auth::id())->get();
        return view('saving_goals.index', compact('savingGoals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('saving_goals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        SavingGoal::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);

        return redirect()->route('saving_goals.index')->with('success', 'Objectif d\'épargne ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('saving_goals.show', compact('savingGoal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('saving_goals.edit', compact('savingGoal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $savingGoal->update([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);

        return redirect()->route('saving_goals.index')->with('success', 'Objectif d\'épargne mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $savingGoal->delete();

        return redirect()->route('saving_goals.index')->with('success', 'Objectif d\'épargne supprimé avec succès.');
    }
}