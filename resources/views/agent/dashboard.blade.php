<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 ('Tableau de bord - ')  {{ Auth::user()->user->name ?? 'Mon Service' }} 
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-end mb-6"> 
            
            <form action="{{ route('dashboard') }}" method="GET" class="relative w-full max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Rechercher un doc, une archive..." 
                       class="w-full pl-10 pr-4 py-2 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                
                @if(request('search'))
                    <form action="{{ route('dashboard') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-red-500">
                        <i class="fas fa-times-circle"></i>
                    </form>
                @endif
            </form>

        </div>

        {{-- </div>
        <div class="bg-white shadow-md rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-50 bg-white flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wider">
                    Répertoire des Documents
                </h3>
                <p class="text-xs text-gray-500 mt-1">
                    @if(request('search'))
                        Résultats pour : <span class="font-semibold text-blue-600">"{{ request('search') }}"</span>
                    @else
                        Liste complète de votre service
                    @endif
                </p>
            </div>
            <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                {{ $documents->count() }} @choice('document|documents', $documents->count())
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Document</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Référence</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase text-center">Date d'ajout</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($documents as $doc)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-red-50 rounded-lg group-hover:bg-red-100 transition-colors">
                                        <i class="fas fa-file-pdf text-red-500 text-lg"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $doc->nom }}</div>
                                        <div class="text-xs text-gray-500 uppercase">{{ $doc->type ?? 'Archive' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-xs font-mono font-medium bg-gray-100 text-gray-700 rounded-md border border-gray-200">
                                    {{ $doc->reference }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-600">
                                {{ $doc->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                                    <i class="fas fa-eye mr-2"></i> Consulter
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-search text-gray-200 text-5xl mb-4"></i>
                                    <p class="text-gray-500 font-medium">Aucun document ne correspond à votre recherche.</p>
                                    <p class="text-sm text-gray-400">Essayez de modifier vos mots-clés ou l'année.</p>
                                    @if(request('search'))
                                        <a href="{{ route('agent.dashboard') }}" class="mt-4 text-blue-600 font-bold hover:underline text-sm">
                                            Voir tous les documents
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-indigo-500">
                <div class="text-sm font-medium text-gray-500 uppercase">Total Documents</div>
                <div class="text-3xl font-bold">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                <div class="text-sm font-medium text-gray-500 uppercase">Courriers Entrants</div>
                <div class="text-3xl font-bold">{{ $stats['entrants'] }}</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-orange-500">
                <div class="text-sm font-medium text-gray-500 uppercase">Courriers Sortants</div>
                <div class="text-3xl font-bold">{{ $stats['sortants'] }}</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-gray-500">
                <div class="text-sm font-medium text-gray-500 uppercase">Notes Internes</div>
                <div class="text-3xl font-bold">{{ $stats['internes'] }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Actions Rapides</h3>
                <div class="space-y-4 flex-grow">
                    <a href="{{ route('agent.document.create') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition border border-green-200">
                        <div class="p-3 bg-green-500 rounded-full text-white mr-4">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div>
                            <span class="block font-bold text-green-800 text-lg">Nouveau Document</span>
                            <span class="text-sm text-green-600">Créer un document numérique interne</span>
                        </div>
                    </a>

                    <a href="{{ route('agent.archive.create') }}" class="flex items-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition border border-indigo-200">
                        <div class="p-3 bg-indigo-500 rounded-full text-white mr-4">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <div>
                            <span class="block font-bold text-indigo-800 text-lg">Archiver un Scan</span>
                            <span class="text-sm text-indigo-600">Importer un document physique numérisé</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Ajouts Récents</h3>
                <ul class="divide-y divide-gray-100 flex-grow">
                    @foreach($stats['recent'] as $doc)
                        <li class="py-3 flex justify-between items-center hover:bg-gray-50 px-2 rounded transition">
                            <div>
                                <span class="block font-medium text-gray-800">{{ $doc->title }}</span>
                                <span class="text-xs text-gray-400 uppercase tracking-tighter">{{ $doc->reference }} • {{ $doc->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold bg-indigo-50 px-3 py-1 rounded">Voir</a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
</x-app-layout>