<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    { 
    $user = Auth::user();
    $serviceId = $user->service_id;
    $search = $request->query('search');

    // 1. Logique de recherche pour les documents/archives
    $query = Document::where('service_id', $serviceId);

    // if ($search) {
    //     $query->where(function($q) use ($search) {
    //         $q->where('LOWER(nom)', 'LIKE', "%{$search}%")
    //           ->orWhere('LOWER(reference)', 'LIKE', "%{$search}%")
    //           ->orWhereYear('LOWER(created_at)', $search)->get(); // Filtrage par année
    //           dd($document);
    //     });
    // }
// if ($search) {
//     $test = Document::where('reference', 'LIKE', '%' . $search . '%')->get();
//     dd([
//         'recherche_tapée' => $search,
//         'resultats_trouvés' => $test,
//         'sql_genere' => Document::where('reference', 'LIKE', '%' . $search . '%')->toSql()
//     ]);
// }

$search = trim($request->query('search'));
$serviceId = Auth::user()->service_id;

//$query = Document::where('service_id', $serviceId);
$query = Document::query();
if ($search) {
    $query->where(function($q) use ($search) {
        // On cherche dans 'nom' ET dans 'reference'
        $q->where('nom', 'LIKE', "%{$search}%")
          ->orWhere('reference', 'LIKE', "%{$search}%");
          
        // Si la recherche est un nombre (année), on ajoute le filtre année
        if (is_numeric($search) && strlen($search) == 4) {
            $q->orWhereYear('created_at', $search);
        }
    });
}

$documents = $query->latest()->get();


    // On récupère les documents filtrés (ou tous si pas de recherche)
    $documents = $query->latest()->paginate(10);
        // Statistiques du service
        $stats = [
            'total'    => Document::where('service_id', $serviceId)->count(),
            'entrants' => Document::where('service_id', $serviceId)->where('type', 'entrant')->count(),
            'sortants' => Document::where('service_id', $serviceId)->where('type', 'sortant')->count(),
            'internes' => Document::where('service_id', $serviceId)->where('type', 'interne')->count(),
            'recent'   => Document::where('service_id', $serviceId)->latest()->take(5)->get(),
        ];

        return view('agent.dashboard', compact('stats','documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
