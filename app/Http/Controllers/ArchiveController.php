<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Document;
class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Document::query(); // Utilise le chemin complet pour être sûr
    $user = auth()->user(); 

    // Filtrage par service
    if ($user && $user->service_id) {
        $query->where('service_id', $user->service_id);
    }

    // Logique de recherche
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('reference', 'LIKE', "%{$search}%");
        });
    }

    // C'est cette variable $archives qui doit être envoyée !
    $archives = $query->latest()->paginate(10);

    // Vérifie bien que tu as mis 'archives' dans le compact
    return view('agent.archive.index', compact('archives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent.archive.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation stricte pour les fichiers scannés (souvent des PDF ou Images)
        $request->validate([
            'reference' => 'required|unique:documents,reference',
            'title'     => 'required|string|max:255',
            'type'      => 'required|in:entrant,sortant,interne',
            'file'      => 'required|mimes:pdf,jpg,jpeg,png|max:10240', // Limite à 10Mo pour les scans haute qualité
        ]);

        if ($request->hasFile('file')) {
            // Organisation automatique : storage/app/public/archives/2026/nom_fichier.pdf
            $yearFolder = date('Y');
            $path = $request->file('file')->store("archives/{$yearFolder}", 'public');

            // Création de l'entrée dans la table documents (qui sert de base commune)
            Document::create([
                'reference'  => $request->reference,
                'title'      => $request->title,
                'type'       => $request->type,
                'file_path'  => $path,
                'year'       => $yearFolder,
                'user_id'    => Auth::id(),
                'service_id' => Auth::user()->service_id,
            ]);

            return redirect()->route('agent.archive.index')
                             ->with('success', 'Le document scanné a été archivé avec succès.');
        }

        return back()->with('error', 'Échec du téléchargement du scan.');
    
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
    public function destroy(string $id)
    {
        //
    }
}
