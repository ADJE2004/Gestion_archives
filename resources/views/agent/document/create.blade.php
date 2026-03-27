<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enregistrer un nouveau document') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('agent.document.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="reference" :value="__('Référence (ex: 2024/MTFP/001)')" />
                        <x-text-input id="reference" name="reference" type="text" class="mt-1 block w-full" :value="old('reference')" required />
                        <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Objet du courrier')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('Type de flux')" />
                        <select name="type" id="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                            <option value="entrant">Courrier Entrant</option>
                            <option value="sortant">Courrier Sortant</option>
                            <option value="interne">Note Interne</option>
                        </select>
                    </div>
                        
                    <div>
                        <x-input-label for="file" :value="__('Fichier du document (PDF, max 10MB)')" />
                        <x-text-input id="file" name="file" type="file" class="mt-1 block w-full" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required />
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Enregistrer le document ') }}</x-primary-button>
                        <a href="{{ route('agent.document.index') }}" class="text-sm text-gray-600 hover:underline">Annuler</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
