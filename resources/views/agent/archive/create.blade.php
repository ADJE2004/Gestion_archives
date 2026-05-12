<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Archivage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8">
                <div class="mb-6 border-b pb-4">
                    <p class="text-sm text-gray-600">
                        Utilisez ce formulaire pour enregistrer un document physique que vous avez préalablement scanné.
                    </p>
                </div>

                <form action="{{ route('agent.archive.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="reference" :value="__('Référence du document (ex: N° d\'ordre)')" />
                        <x-text-input id="reference" name="reference" type="text" class="mt-1 block w-full bg-gray-50" :value="old('reference')" placeholder="REF-2026-001" required />
                        <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="titre" :value="__('Objet / Titre du document')" />
                        <x-text-input id="titre" name="titre" type="text" class="mt-1 block w-full" :value="old('titre')" required />
                        <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="type" :value="__('Categorie')" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                                <option value="entrant">Courrier Entrant</option>
                                <option value="sortant">Courrier Sortant</option>
                                <option value="interne">Note Interne</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="file" :value="__('Fichier scanné (PDF ou Image)')" />
                            <input id="file" name="file" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept=".pdf,.jpg,.jpeg,.png" required />
                            <p class="mt-1 text-xs text-gray-400">PDF, JPG ou PNG (Max. 10 Mo)</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <a href="{{ route('agent.archive.index') }}" class="text-sm text-gray-500 hover:underline mr-6">Retour à la liste</a>
                        <x-primary-button class="bg-indigo-600">
                            {{ __('Lancer l\'archivage') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</x-app-layout>