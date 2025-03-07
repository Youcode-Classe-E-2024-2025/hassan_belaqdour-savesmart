<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Importez la facade DB pour les transactions

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedFamilyProfileId = session('selected_family_profile_id');

        $transactions = Transaction::where('user_id', Auth::id())
            ->when($selectedFamilyProfileId, function ($query) use ($selectedFamilyProfileId) {
                return $query->where('family_profile_id', $selectedFamilyProfileId);
            })
            ->orderBy('date', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id,user_id,' . Auth::id(),
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:revenu,depense',
        ]);

        $selectedFamilyProfileId = session('selected_family_profile_id');

        $user = Auth::user();
        $amount = $request->amount;
        $type = $request->type;

        DB::beginTransaction(); // Démarrez la transaction

        try {
            if ($type === 'revenu') {
                $user->revenu_mensuel += $amount;
            } elseif ($type === 'depense') {
                $user->revenu_mensuel -= $amount;
            }

            $user->save();

            Transaction::create([
                'user_id' => Auth::id(),
                'family_profile_id' => $selectedFamilyProfileId,
                'category_id' => $request->category_id,
                'amount' => $amount,
                'date' => $request->date,
                'description' => $request->description,
                'type' => $type,
            ]);

            DB::commit(); // Validez la transaction
            return redirect()->route('transactions.index')->with('success', 'Transaction ajoutée avec succès.');

        } catch (\Exception $e) {
            DB::rollback(); // Annulez la transaction en cas d'erreur
            \Log::error($e); // Log l'erreur pour le débogage
            return back()->with('error', 'Erreur lors de l\'ajout de la transaction. Veuillez réessayer.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::where('user_id', Auth::id())->get();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id,user_id,' . Auth::id(),
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:revenu,depense',
        ]);

        $transaction->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction supprimée avec succès.');
    }
}