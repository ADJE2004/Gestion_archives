<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Document;
class DocumentController extends Controller
{
    public function index(Request $request) 
{
    // 1. On commence la requête sur le modèle Document
    $query = Document::query();

    $user = Auth::user(); 
    if ($user && $user->service_id) {
        $query->where('service_id', $user->service_id);
    }

    // 2. On filtre pour que l'agent ne voie QUE les documents de son service
    // On vérifie quand même que l'utilisateur a bien un service_id pour éviter un crash
    if ($user->service_id) {
        $query->where('service_id', $user->service_id);
    }

    // 3. LOGIQUE DE RECHERCHE
    // Maintenant $request est reconnu !
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('reference', 'LIKE', "%{$search}%");
        });
    }

    $documents = $query->latest()->paginate(10);

    return view('agent.document.index', compact('documents')); 
}

        public function create()
    {
        return view('agent.document.create');
    }       

    public function store(Request $request)
{
    $request->validate([
        'reference' => 'required|unique:documents,reference',
        'title' => 'required|string|max:255',
        'type' => 'required|in:entrant,sortant,interne',
        'file' => 'required|mimes:pdf,jpg,png|max:5120', // Limite à 5Mo
    ]);

    if ($request->hasFile('file')) {
            $path = $request->file('file')->store('archives/' . date('Y'), 'public');

            // 3. Création de l'enregistrement en base de données
            Document::create([
                'reference'  => $request->reference,
                'title'      => $request->title,
                'type'       => $request->type,
                'file_path'  => $path,
                'year'       => date('Y'), // On règle ton erreur "Field year doesn't have a default value"
                'user_id'    => auth::id(), // L'ID de l'agent qui crée
                'service_id' => auth::user()->service_id, // On récupère le service de l'agent
            ]);

            return redirect()->route('agent.document.index')
                             ->with('success', 'Le document a été archivé avec succès !');
        }

        return back()->with('error', 'Le fichier est manquant.');
    }

    public function edit($id)
{
    $document = Document::findOrFail($id);
    return view('agent.document.edit', compact('document'));
}

    public function update(Request $request, $id)
{
    $document = Document::findOrFail($id);

    $request->validate([
        'reference' => 'required|unique:documents,reference,' . $document->id,
        'title' => 'required|string|max:255',
        'type' => 'required|in:entrant,sortant,interne',
        'file' => 'nullable|mimes:pdf,jpg,png|max:5120', // Limite à 5Mo
    ]);

    if ($request->hasFile('file')) {
        // Supprimer l'ancien fichier si nécessaire
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        // Stocker le nouveau fichier
        $path = $request->file('file')->store('archives/' . date('Y'), 'public');
        $document->file_path = $path;
    }

    // Mettre à jour les autres champs
    $document->reference = $request->reference;
    $document->title = $request->title;
    $document->type = $request->type;
    $document->save();

    return redirect()->route('agent.document.index') ->with('success', 'Le document a été mis à jour avec succès !');
}

    public function destroy($id)
{
    $document = Document::findOrFail($id);
    // Supprimer le fichier du stockage
    if ($document->file_path) {
        Storage::disk('public')->delete($document->file_path);
    }
        $document->delete();

    return redirect()->route('agent.document.index') ->with('success', 'Le document a été supprimé avec succès !');
}
}