<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $services = Service::withCount('users')->get();
    return view('admin.services.index', compact('services'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  //dd($request->all());
        $request->validate([
            'name' => 'required|unique:services|max:255',
        ]);
        Service::create([
        'name' => $request->name
    ]);

    return redirect()->route('admin.services.index')->with('success', 'Service ajouté !');    }

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
    public function destroy(Service $service)
    {
        if($service->users()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer : ce service contient des utilisateurs.');
        }
        
        $service->delete();
        return back()->with('success', 'Service supprimé.');
    }
    
}
