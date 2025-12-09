<nav x-data="{ open: false }" class="bg-cb-dark border-b-2 border-cb-green/30 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="hover:opacity-80 transition">
                        <div class="text-white text-2xl font-extrabold flex items-center space-x-2">
                            <i class="fas fa-terminal text-cb-green drop-shadow-lg"></i>
                            <span class="drop-shadow-lg">CodeBattle</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- Inicio - Visible para todos --}}
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('Inicio') }}
                    </x-nav-link>

                    @auth
                        {{-- Concursos - Visible para usuarios autenticados --}}
                        <x-nav-link href="{{ route('welcome') }}#concursos" :active="false">
                            <i class="fas fa-trophy mr-2"></i>
                            {{ __('Concursos') }}
                        </x-nav-link>

                        {{-- SUPER ADMIN: Gestión de Usuarios (exclusivo) --}}
                        @role('super_admin')
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                <i class="fas fa-users-cog mr-2 text-purple-400"></i>
                                {{ __('Usuarios') }}
                            </x-nav-link>
                        @endrole

                        {{-- ADMIN y SUPER ADMIN: Panel de Administración --}}
                        @hasanyrole('admin|super_admin')
                            <x-nav-link :href="route('admin.contests.index')" :active="request()->routeIs('admin.contests.*')">
                                <i class="fas fa-shield-alt mr-2"></i>
                                {{ __('Panel Admin') }}
                            </x-nav-link>

                            {{-- Jueces --}}
                            <x-nav-link :href="route('admin.judges.index')" :active="request()->routeIs('admin.judges.*')">
                                <i class="fas fa-gavel mr-2"></i>
                                {{ __('Jueces') }}
                            </x-nav-link>

                            {{-- Clasificación --}}
                            <x-nav-link :href="route('leaderboard.index')" :active="request()->routeIs('leaderboard.index')">
                                <i class="fas fa-chart-bar mr-2"></i>
                                {{ __('Clasificación') }}
                            </x-nav-link>
                        @endhasanyrole
                        
                        {{-- Mi Perfil - Visible para todos los autenticados --}}
                        <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                            <i class="fas fa-user mr-2"></i>
                            {{ __('Mi Perfil') }}
                        </x-nav-link>

                        {{-- Blog - Visible para todos los autenticados --}}
                        <x-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')">
                            <i class="fas fa-blog mr-2"></i>
                            {{ __('Blog') }}
                        </x-nav-link>

                        {{-- Sedes - Visible para todos los autenticados --}}
                        <x-nav-link :href="route('venues.index')" :active="request()->routeIs('venues.index')">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ __('Sedes') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-400 bg-cb-card hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center space-x-2">
                                    @role('super_admin')
                                        <i class="fas fa-shield-halved text-purple-400"></i>
                                    @elserole('admin')
                                        <i class="fas fa-crown text-yellow-400"></i>
                                    @elserole('juez')
                                        <i class="fas fa-gavel text-blue-400"></i>
                                    @endrole
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @role('admin')
                                <x-dropdown-link :href="route('admin.contests.index')">
                                    <i class="fas fa-shield-alt mr-2 text-yellow-400"></i>
                                    <span class="text-gray-300">{{ __('Panel de Administración') }}</span>
                                </x-dropdown-link>
                                <div class="border-t border-cb-border my-1"></div>
                            @endrole

                            @can('ver-perfil')
                            <x-dropdown-link :href="route('profile.index')">
                                <i class="fas fa-user mr-2 text-cb-green"></i>
                                <span class="text-gray-300">{{ __('Mi Perfil') }}</span>
                            </x-dropdown-link>
                            @endcan

                            @can('editar-perfil')
                            <x-dropdown-link :href="route('profile.edit')">
                                <i class="fas fa-cog mr-2 text-gray-400"></i>
                                <span class="text-gray-300">{{ __('Configuración') }}</span>
                            </x-dropdown-link>
                            @endcan

                            <div class="border-t border-cb-border my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2 text-red-400"></i>
                                    <span class="text-gray-300">{{ __('Cerrar Sesión') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Botón de login para usuarios no autenticados --}}
                    <a href="{{ route('login') }}" class="bg-cb-green hover:bg-emerald-500 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 shadow-lg hover:shadow-cb-green/50 hover:scale-105 transform">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                @auth
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-cb-dark focus:outline-none focus:bg-cb-dark transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-cb-dark border-t border-cb-green/30">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                {{-- Inicio --}}
                <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                    <i class="fas fa-home mr-2"></i>
                    {{ __('Inicio') }}
                </x-responsive-nav-link>

                {{-- Concursos --}}
                @can('ver-concursos')
                <x-responsive-nav-link href="{{ route('welcome') }}#concursos" :active="false">
                    <i class="fas fa-trophy mr-2"></i>
                    {{ __('Concursos') }}
                </x-responsive-nav-link>
                @endcan

                {{-- Panel Admin - Solo admin --}}
                @role('admin')
                    <x-responsive-nav-link :href="route('admin.contests.index')" :active="request()->routeIs('admin.contests.*')">
                        <i class="fas fa-shield-alt mr-2 text-yellow-400"></i>
                        {{ __('Panel Admin') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.judges.index')" :active="request()->routeIs('admin.judges.*')">
                        <i class="fas fa-gavel mr-2"></i>
                        {{ __('Jueces') }}
                    </x-responsive-nav-link>
                @endrole

                {{-- Clasificación --}}
                @can('ver-clasificacion')
                <x-responsive-nav-link :href="route('leaderboard.index')" :active="request()->routeIs('leaderboard.index')">
                    <i class="fas fa-chart-bar mr-2"></i>
                    {{ __('Clasificación') }}
                </x-responsive-nav-link>
                @endcan

                {{-- Mi Perfil --}}
                @can('ver-perfil')
                <x-responsive-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                    <i class="fas fa-user mr-2"></i>
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>
                @endcan

                {{-- Blog --}}
                @can('ver-blog')
                <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')">
                    <i class="fas fa-blog mr-2"></i>
                    {{ __('Blog') }}
                </x-responsive-nav-link>
                @endcan

                {{-- Sedes --}}
                @can('ver-sedes')
                <x-responsive-nav-link :href="route('venues.index')" :active="request()->routeIs('venues.index')">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    {{ __('Sedes') }}
                </x-responsive-nav-link>
                @endcan
            </div>

            <!-- User Info Section (Mobile) -->
            <div class="pt-4 pb-1 border-t border-cb-border">
                <div class="px-4">
                    <div class="font-medium text-base text-white flex items-center space-x-2">
                        @role('admin')
                            <i class="fas fa-crown text-yellow-400"></i>
                        @endrole
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    {{-- Configuración --}}
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-cog mr-2"></i>
                        {{ __('Configuración') }}
                    </x-responsive-nav-link>

                    {{-- Cerrar Sesión --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2 text-red-400"></i>
                            {{ __('Cerrar Sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>