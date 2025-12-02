<nav x-data="{ open: false }" class="bg-slate-950 border-b border-slate-900 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <div class="flex-shrink-0 flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                        <svg class="w-6 h-6 text-slate-950" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-cyan-400 tracking-tight">CodeBattle</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-1 lg:space-x-4">

                <a href="{{ route('welcome') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-bold transition-colors rounded-lg shadow-sm
                    {{ request()->routeIs('welcome')
                        ? 'bg-cyan-950/30 border border-cyan-500/20 text-cyan-400'
                        : 'text-gray-400 hover:text-white border border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    Inicio
                </a>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-bold transition-colors rounded-lg shadow-sm
                    {{ request()->routeIs('dashboard')
                        ? 'bg-cyan-950/30 border border-cyan-500/20 text-cyan-400'
                        : 'text-gray-400 hover:text-white border border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Concursos
                </a>

                <a href="{{ route('leaderboard') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-bold transition-colors rounded-lg shadow-sm
                    {{ request()->routeIs('leaderboard')
                        ? 'bg-cyan-950/30 border border-cyan-500/20 text-cyan-400'
                        : 'text-gray-400 hover:text-white border border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                    </svg>
                    Clasificación
                </a>

                <a href="{{ route('profile.index') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-bold transition-colors rounded-lg shadow-sm
                    {{ request()->routeIs('profile.index')
                        ? 'bg-cyan-950/30 border border-cyan-500/20 text-cyan-400'
                        : 'text-gray-400 hover:text-white border border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Mi Perfil
                </a>

                <a href="{{ route('blog.index') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-bold transition-colors rounded-lg shadow-sm
                    {{ request()->routeIs('blog.index')
                        ? 'bg-cyan-950/30 border border-cyan-500/20 text-cyan-400'
                        : 'text-gray-400 hover:text-white border border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Blog
                </a>

                <a href="{{ route('sedes.index') }}"
                    class="flex items-center gap-2 px-3 py-2 text-sm font-bold transition-colors rounded-lg shadow-sm
                    {{ request()->routeIs('sedes.index')
                        ? 'bg-cyan-950/30 border border-cyan-500/20 text-cyan-400'
                        : 'text-gray-400 hover:text-white border border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Sedes
                </a>

            </div>

            <div class="hidden md:flex items-center">
                <a href="{{ route('login') }}"
                    class="group relative flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-xl text-slate-950 font-bold text-sm transition-all hover:shadow-lg hover:shadow-cyan-500/25 hover:scale-105">
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Iniciar Sesión
                </a>
            </div>

            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-slate-800 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'block': !open }" class="block" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'block': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden bg-slate-900 border-b border-slate-800">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('welcome') }}" class="block px-3 py-2 {{ request()->routeIs('welcome') ? 'bg-cyan-900/30 text-cyan-400 rounded-md' : 'text-gray-300' }}">Inicio</a>
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-cyan-900/30 text-cyan-400 rounded-md' : 'text-gray-300' }}">Concursos</a>
            <a href="{{ route('leaderboard') }}" class="block px-3 py-2 {{ request()->routeIs('leaderboard') ? 'bg-cyan-900/30 text-cyan-400 rounded-md' : 'text-gray-300' }}">Clasificación</a>
            <a href="{{ route('profile.index') }}" class="block px-3 py-2 {{ request()->routeIs('profile.index') ? 'bg-cyan-900/30 text-cyan-400 rounded-md' : 'text-gray-300' }}">Mi Perfil</a>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2 {{ request()->routeIs('blog.index') ? 'bg-cyan-900/30 text-cyan-400 rounded-md' : 'text-gray-300' }}">Blog</a>
            <a href="{{ route('sedes.index') }}" class="block px-3 py-2 {{ request()->routeIs('sedes.index') ? 'bg-cyan-900/30 text-cyan-400 rounded-md' : 'text-gray-300' }}">Sedes</a>
        </div>
    </div>
</nav>
