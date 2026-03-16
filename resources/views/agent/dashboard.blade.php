<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

     <div class="p-6">
        <h3>Bienvenue {{ auth()->user()->name }}</h3>

        <p>Rôle : {{ auth()->user()->role }}</p>

        <p>
            Service :
            {{ auth()->user()->service->name ?? 'Aucun service' }}
        </p>
    </div>

</x-app-layout>
