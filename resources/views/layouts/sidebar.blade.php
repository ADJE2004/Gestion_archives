<div class="w-64 bg-gray-900 text-white min-h-screen flex flex-col shadow-xl">
    <div class="p-6 text-center border-b border-gray-800">
        <h1 class="text-xl font-bold tracking-widest text-blue-400">ARCHIVES</h1>
        <p class="text-xs text-gray-500 uppercase mt-1">{{ Auth::user()->role }}</p>
    </div>

    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400' }}">
            <i class="fas fa-home mr-3"></i> Dashboard
        </a>

        @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2 text-xs font-semibold text-gray-600 uppercase">Administration</div>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-400">
                <i class="fas fa-users-cog mr-3"></i> Utilisateurs
            </a>
        @endif

        @if(in_array(Auth::user()->role, ['agent', 'chef']))
            <div class="pt-4 pb-2 text-xs font-semibold text-gray-600 uppercase"></div>
            <a href="{{ route('agent.document.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-400">
                <i class="fas fa-file-invoice mr-3"></i> Mes documents
            </a>
            <a href="{{ route('agent.archive.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-400">
                <i class="fas fa-plus-circle mr-3"></i> Mes archives
            </a>
        @endif
    </nav>

    <div class="p-4 border-t border-gray-800 bg-gray-900">
        <div class="flex items-center mb-4 px-2">
            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-sm font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3 overflow-hidden">
                <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                <a href="{{ route('profile.edit') }}" class="text-xs text-gray-500 hover:text-blue-400">Modifier profil</a>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full p-2 text-sm text-red-400 hover:bg-red-900/20 rounded-lg transition">
                <i class="fas fa-power-off mr-3"></i> Déconnexion
            </button>
        </form>
    </div>
</div>