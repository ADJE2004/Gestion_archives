<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-building mr-2 text-blue-500"></i> {{ __('Gestion des Services') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-6 bg-white shadow sm:rounded-lg border-l-4 border-blue-500">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Créer un nouveau département / service</h3>
                
                <form action="{{ route('admin.services.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="name" value="{{ old('name') }}" 
                               placeholder="Ex: Ressources Humaines, Comptabilité, Logistique..." 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nom') border-red-500 @enderror" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-plus mr-2"></i> Ajouter le service
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>