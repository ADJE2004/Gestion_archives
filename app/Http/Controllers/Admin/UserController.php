<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('service')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all(); // On récupère tous les services
            return view('admin.users.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
        ]);

        // 2. Création de l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'service_id' => $request->service_id,
            'password' => Hash::make('password123'), // Mot de passe par défaut
            'must_change_password' => true, // Pour ton middleware de sécurité
        ]);

        // 3. Redirection pour éviter la page blanche
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
     {
        $user = User::findOrFail($userId);
    {
        $user->delete();

    // On redirige IMMÉDIATEMENT vers la liste avec un message de succès
    return redirect()->route('admin.users.index')
                     ->with('success', 'L’utilisateur a été supprimé avec succès.');
    }
}
}