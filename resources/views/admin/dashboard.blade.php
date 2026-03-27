<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de Bord Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full text-blue-600"><i class="fas fa-users fa-2x"></i></div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 uppercase">Utilisateurs</p>
                            <p class="text-2xl font-bold">{{ $stats['users_count'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full text-green-600"><i class="fas fa-building fa-2x"></i></div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 uppercase">Services</p>
                            <p class="text-2xl font-bold">{{ $stats['services_count'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full text-purple-600"><i class="fas fa-file-alt fa-2x"></i></div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 uppercase">Documents Total</p>
                            <p class="text-2xl font-bold">{{ $stats['docs_count'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-lg mb-4">Derniers documents archivés (Global)</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3 text-sm">Référence</th>
                                <th class="p-3 text-sm">Titre</th>
                                <th class="p-3 text-sm">Agent</th>
                                <th class="p-3 text-sm">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['recent_docs'] as $doc)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-mono text-xs text-blue-600">{{ $doc->reference }}</td>
                                <td class="p-3 text-sm">{{ $doc->title }}</td>
                                <td class="p-3 text-sm">{{ $doc->user->name }}</td>
                                <td class="p-3 text-sm text-gray-500">{{ $doc->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>