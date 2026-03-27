<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 ('Tableau de bord - ')  {{ Auth::user()->service->name ?? 'Mon Service' }} 
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
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