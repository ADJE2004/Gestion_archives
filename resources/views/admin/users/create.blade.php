<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nom Complet</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Adresse Email</label>
                        <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Rôle</label>
                        <select name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="agent">Agent</option>
                            <option value="cs">Chef de Service (CS)</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Service / Département</label>
                        <select name="service_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Sélectionner un service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                            Enregistrer l'utilisateur
                        </button>
                    </div>
                </form>
                <p class="mt-4 text-xs text-gray-500 italic">
                    * Le mot de passe par défaut sera généré automatiquement et l'utilisateur devra le changer à sa première connexion.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>