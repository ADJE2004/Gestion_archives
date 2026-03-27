<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 ('Tableau de bord - ')  {{ Auth::user()->service->name ?? 'Mon Service' }} 
        </h2>
    </x-slot>

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Date & Heure</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Utilisateur</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Action</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Document</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($histories as $log)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ $log->created_at->format('d/m/Y H:i') }}
                </td>
                
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-[10px] font-bold 
                        {{ $log->action == 'Suppression' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ strtoupper($log->action) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm font-medium text-gray-700">{{ $log->document_title }}</p>
                    <p class="text-xs text-indigo-500">{{ $log->document_ref }}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>   