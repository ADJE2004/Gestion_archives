<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('agent.document.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <label>Référence</label>
                        <input type="text" name="reference" value="{{ old('reference', $document->reference) }}" class="block w-full rounded-md border-gray-300">
                    </div>

                    <div class="mt-4">
                        <label>Objet / Titre</label>
                        <input type="text" name="title" value="{{ old('title', $document->title) }}" class="block w-full rounded-md border-gray-300">
                    </div>

                    <div class="mt-4">
                        <label>Type</label>
                        <select name="type" class="block w-full rounded-md border-gray-300">
                            <option value="entrant" {{ $document->type == 'entrant' ? 'selected' : '' }}>Entrant</option>
                            <option value="sortant" {{ $document->type == 'sortant' ? 'selected' : '' }}>Sortant</option>
                            <option value="interne" {{ $document->type == 'interne' ? 'selected' : '' }}>Interne</option>
                        </select>
                    </div>

                    <button type="submit" class="mt-4 bg-amber-600 text-white px-4 py-2 rounded-md">
                        Mettre à jour
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>