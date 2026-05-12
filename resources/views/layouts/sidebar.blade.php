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
          
         <div x-data="{ open: {{ request()->routeIs('admin.services.*') ? 'true' : 'false' }} }" class="px-3 mb-2">
             <button @click="open = !open" 
                class="flex items-center justify-between w-full p-3 rounded-lg transition-colors hover:bg-gray-800 text-gray-400 group focus:outline-none">
            
                <div class="flex items-center">
                    <i class="fas fa-users-cog mr-3 text-lg group-hover:text-blue-400"></i>
                    <span class="group-hover:text-white text-sm font-medium">Gestion-Services</span>
                </div>
        
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
             </button>
                <div x-show="open" 
                    x-cloak 
                    x-transition:enter="transition ease-out duration-100"
                    class="mt-1 ml-4 space-y-1 border-l-2 border-gray-700">
                    
                    <a href="{{ route('admin.services.index') }}" 
                    class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group {{ request()->routeIs('admin.services.index') ? 'text-white bg-gray-800 border-l-2 border-green-500 -ml-[2px]' : 'text-gray-500 hover:text-gray-300' }}">
                        <i class="fas fa-list mr-3 text-xs"></i>
                        <span class="text-sm">Services list</span>
                    </a>

                    <a href="{{ route('admin.services.create') }}" 
                         class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group text-gray-500 hover:text-gray-300">
                        <i class="fas fa-plus-circle mr-3 text-xs"></i>
                        <span class="text-sm">Add a service</span>
                    </a>
                </div>
            </div>

  <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }" class="px-3 mb-2">
 <button @click="open = !open" 
                class="flex items-center justify-between w-full p-3 rounded-lg transition-colors hover:bg-gray-800 text-gray-400 group focus:outline-none">
                <div class="flex items-center">
                    <i class="fas fa-users-cog mr-3 text-lg group-hover:text-blue-400"></i>
                    <span class="group-hover:text-white text-sm font-medium">Gestion users</span>
                </div>
        
                <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
             </button>
                <div x-show="open" 
                    x-cloak 
                    x-transition:enter="transition ease-out duration-100"
                    class="mt-1 ml-4 space-y-1 border-l-2 border-gray-700">
                    
                    <a href="{{ route('admin.users.index') }}" 
                    class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group {{ request()->routeIs('admin.services.index') ? 'text-white bg-gray-800 border-l-2 border-green-500 -ml-[2px]' : 'text-gray-500 hover:text-gray-300' }}">
                        <i class="fas fa-list mr-3 text-xs"></i>
                        <span class="text-sm">User list</span>
                    </a>

                    <a href="{{ route('admin.users.create') }}" 
                         class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group text-gray-500 hover:text-gray-300">
                        <i class="fas fa-plus-circle mr-3 text-xs"></i>
                        <span class="text-sm">Add a user</span>
                    </a>
                </div>
            </div>
    <div x-data="{ open: false }" class="px-3 mb-2">
    <button @click="open = !open" class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-800 text-gray-400 group">
        <div class="flex items-center whitespace-nowrap">
            <i class="fas fa-cogs mr-3 text-lg group-hover:text-orange-400"></i>
            <span class="group-hover:text-white font-medium text-sm">Paramètres</span>
        </div>
        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
    </button>

    <div x-show="open" x-cloak class="mt-1 ml-4 border-l-2 border-gray-700 space-y-1">
        <a href="#" class="block p-2 pl-6 text-sm text-gray-500 hover:text-white">Configuration Générale</a>
        <a href="#" class="block p-2 pl-6 text-sm text-gray-500 hover:text-white">Rôles & Permissions</a>
        <a href="#" class="block p-2 pl-6 text-sm text-gray-500 hover:text-white">Journal d'activités</a>
    </div>
</div>
@endif


    @if(Auth::user()->role !== 'admin')
        <div x-data="{ open: {{ request()->routeIs('agent.*') ? 'true' : 'false' }} }" class="px-3">
        <button @click="open = !open" 
                class="flex items-center justify-between w-full p-3 rounded-lg transition-colors hover:bg-gray-800 text-gray-400 group">
            <div class="flex items-center">
                <i class="fas fa-folder-open mr-3 text-lg group-hover:text-white"></i>
                <span class="group-hover:text-white font-medium">Documents</span>
            </div>
            
            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open" 
             x-cloak 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             class="mt-1 ml-4 space-y-1 border-l-2 border-gray-700">
            
            <a href="{{ route('agent.document.index') }}" 
               class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group {{ request()->routeIs('agent.document.index') ? 'text-white bg-gray-800' : 'text-gray-500' }}">
                <i class="fas fa-file-invoice mr-3 text-sm"></i>
                <span class="text-sm">Mes documents</span>
            </a>

            <a href="{{ route('agent.document.create') }}" 
               class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group {{ request()->routeIs('agent.archive.create') ? 'text-white bg-gray-800' : 'text-gray-500' }}">
                <i class="fas fa-plus-circle mr-3 text-sm"></i>
                <span class="text-sm">Nouveau doc</span>
            </a>
        </div>
        </div>

        <div x-data="{ open: {{ request()->routeIs('agent.*') ? 'true' : 'false' }} }" class="px-3">
             <button @click="open = !open" 
                class="flex items-center justify-between w-full p-3 rounded-lg transition-colors hover:bg-gray-800 text-gray-400 group">
            <div class="flex items-center">
                <i class="fas fa-folder-open mr-3 text-lg group-hover:text-white"></i>
                <span class="group-hover:text-white font-medium">Archives</span>
            </div>
            
            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
             </button>
         <div x-show="open" 
             x-cloak 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             class="mt-1 ml-4 space-y-1 border-l-2 border-gray-700">
            
            <a href="{{ route('agent.archive.index') }}" 
               class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group {{ request()->routeIs('agent.document.index') ? 'text-white bg-gray-800' : 'text-gray-500' }}">
                <i class="fas fa-file-invoice mr-3 text-sm"></i>
                <span class="text-sm">Mes archives</span>
            </a>

            <a href="{{ route('agent.archive.create') }}" 
               class="flex items-center p-2 pl-6 rounded-r-lg transition-colors hover:bg-gray-800 group {{ request()->routeIs('agent.archive.create') ? 'text-white bg-gray-800' : 'text-gray-500' }}">
                <i class="fas fa-plus-circle mr-3 text-sm"></i>
                <span class="text-sm">Nouvel archive</span>
            </a>
          </div>
        </div>
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