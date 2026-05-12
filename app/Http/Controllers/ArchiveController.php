<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Archive;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $search = $request->input('search');
    $serviceId = auth()->user()->service_id;

    $archives = Document::where('service_id', $serviceId)
        ->where('origine', 'physique') // On ne prend que les archives scannées ici
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('reference', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

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
// 1. Validation
  //dd($request->all());
    $request->validate([
        'reference' => 'required|unique:documents,reference',
        'titre'     => 'required|string|max:255',
        'type'      => 'required|in:entrant,sortant,interne',
        'file'      => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
    ]);

    if ($request->hasFile('file')) {
        // Stockage du scan
      //  $path = $request->file('file')->store("archives/" . date('Y'), 'public');
   if ($request->hasFile('file')) {
        $yearFolder = date('Y'); // 2026
        $path = $request->file('file')->store("archives/{$yearFolder}", 'public');
        // 2. Enregistrement dans la table UNIQUE
        Document::create([
            'reference'  => $request->reference,
            'titre'      => $request->titre,
            'type'       => $request->type,
            'year'       => $yearFolder,
            'file_path'       => $path,
            'service_id' => auth()->user()->service_id,
            'user_id'    => auth()->id(),
            'origine'    => 'physique', // On marque que c'est une archive physique scannée
        ]);

        return redirect()->route('agent.archive.index')
                         ->with('success', 'Le document physique a été numérisé et archivé.');
    }

    return back()->with('error', 'Erreur lors du téléchargement du fichier.');
}
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
