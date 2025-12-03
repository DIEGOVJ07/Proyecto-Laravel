<x-app-layout>
    
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                Mi Perfil
            </h2>
            @auth
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-cb-green/10 text-cb-green rounded-lg hover:bg-cb-green/20 transition-all text-sm font-medium">
                    <i class="fas fa-cog mr-2"></i>
                    Configurar Cuenta
                </a>
            @endauth
        </div>
    </x-slot>

    {{-- Contenido Principal --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. Información del Usuario --}}
            <div class="bg-cb-card p-8 rounded-xl shadow-xl border border-cb-border">
                <div class="flex items-center space-x-6 mb-8">
                    {{-- Avatar --}}
                    <div class="w-32 h-32 bg-gradient-to-br from-cb-green to-green-600 rounded-2xl flex items-center justify-center text-5xl font-bold text-cb-dark shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold text-white mb-2">{{ $user->name }}</h1>
                        <p class="text-gray-400 text-lg">Miembro desde {{ \Carbon\Carbon::parse($user->created_at)->locale('es')->isoFormat('MMMM YYYY') }}</p>
                        <div class="flex items-center space-x-4 mt-3">
                            <span class="px-3 py-1 bg-cb-green/10 text-cb-green rounded-lg text-sm font-medium">
                                <i class="fas fa-trophy mr-1"></i>
                                Ranking #{{ $stats['global_ranking'] }}
                            </span>
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-lg text-sm font-medium">
                                <i class="fas fa-star mr-1"></i>
                                {{ number_format($stats['total_points']) }} Puntos
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Estadísticas principales en grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-cb-dark/50 p-6 rounded-xl border border-cb-border">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-code text-3xl text-blue-400"></i>
                            <span class="text-4xl font-bold text-white">{{ $stats['problems_solved'] }}</span>
                        </div>
                        <p class="text-gray-400">Problemas Resueltos</p>
                    </div>

                    <div class="bg-cb-dark/50 p-6 rounded-xl border border-cb-border">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-award text-3xl text-yellow-400"></i>
                            <span class="text-4xl font-bold text-white">{{ $stats['contests_won'] }}</span>
                        </div>
                        <p class="text-gray-400">Concursos Ganados</p>
                    </div>

                    <div class="bg-cb-dark/50 p-6 rounded-xl border border-cb-border">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-chart-line text-3xl text-cb-green"></i>
                            <span class="text-4xl font-bold text-white">{{ number_format($stats['total_points']) }}</span>
                        </div>
                        <p class="text-gray-400">Puntos Totales</p>
                    </div>
                </div>
            </div>

            {{-- 2. Información Personal --}}
            <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-user-circle text-cb-green mr-3"></i>
                    Información Personal
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-envelope mr-2"></i>
                                Email:
                            </div>
                            <div class="flex-1 text-white font-medium">
                                {{ $user->email ?? 'demo@codebattle.com' }}
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-calendar mr-2"></i>
                                Registro:
                            </div>
                            <div class="flex-1 text-white font-medium">
                                {{ \Carbon\Carbon::parse($user->created_at)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                Ubicación:
                            </div>
                            <div class="flex-1 text-white font-medium">
                                México
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-trophy mr-2"></i>
                                Ranking:
                            </div>
                            <div class="flex-1 text-white font-medium">
                                #{{ $stats['global_ranking'] }} Global
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-fire mr-2"></i>
                                Racha:
                            </div>
                            <div class="flex-1 text-white font-medium">
                                7 días consecutivos
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-check-circle mr-2"></i>
                                Estado:
                            </div>
                            <div class="flex-1">
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-lg text-sm font-medium">
                                    Activo
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Estadísticas de Concursos --}}
            <div class="grid lg:grid-cols-2 gap-6">
                
                {{-- Concursos Ganados --}}
                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-trophy text-yellow-400 mr-3"></i>
                        Concursos Ganados
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-medal text-yellow-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">Weekly Challenge #45</h4>
                                    <p class="text-gray-400 text-sm">18 Nov 2025</p>
                                </div>
                            </div>
                            <span class="text-yellow-400 font-bold">🥇 1er Lugar</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-medal text-yellow-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">DP Sprint #11</h4>
                                    <p class="text-gray-400 text-sm">10 Nov 2025</p>
                                </div>
                            </div>
                            <span class="text-gray-400 font-bold">🥈 2do Lugar</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-medal text-yellow-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">Algorithm Masters</h4>
                                    <p class="text-gray-400 text-sm">02 Nov 2025</p>
                                </div>
                            </div>
                            <span class="text-orange-400 font-bold">🥉 3er Lugar</span>
                        </div>
                    </div>
                </div>

                {{-- Concursos Perdidos / Participados --}}
                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-list text-blue-400 mr-3"></i>
                        Concursos Recientes
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-blue-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">Weekly Challenge #46</h4>
                                    <p class="text-gray-400 text-sm">25 Nov 2025</p>
                                </div>
                            </div>
                            <span class="text-blue-400 font-bold">5to Lugar</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-blue-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">Graph Theory Challenge</h4>
                                    <p class="text-gray-400 text-sm">23 Nov 2025</p>
                                </div>
                            </div>
                            <span class="text-gray-400 font-bold">12vo Lugar</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-blue-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold">Binary Tree Masters</h4>
                                    <p class="text-gray-400 text-sm">20 Nov 2025</p>
                                </div>
                            </div>
                            <span class="text-gray-400 font-bold">8vo Lugar</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Insignias y Logros --}}
            <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-certificate text-cb-green mr-3"></i>
                    Insignias y Logros
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <div class="bg-cb-dark/50 rounded-xl p-4 text-center border border-cb-border hover:border-cb-green/50 transition-all duration-300">
                        <i class="fas fa-fire text-yellow-500 text-4xl mb-2"></i>
                        <p class="text-sm text-gray-400">Racha de 7 días</p>
                        <span class="text-xs text-cb-green">Desbloqueado</span>
                    </div>
                    
                    <div class="bg-cb-dark/50 rounded-xl p-4 text-center border border-cb-border hover:border-cb-green/50 transition-all duration-300">
                        <i class="fas fa-star text-blue-500 text-4xl mb-2"></i>
                        <p class="text-sm text-gray-400">50 Problemas</p>
                        <span class="text-xs text-cb-green">Desbloqueado</span>
                    </div>
                    
                    <div class="bg-cb-dark/50 rounded-xl p-4 text-center border border-cb-border hover:border-cb-green/50 transition-all duration-300">
                        <i class="fas fa-medal text-cb-green text-4xl mb-2"></i>
                        <p class="text-sm text-gray-400">Primera Victoria</p>
                        <span class="text-xs text-cb-green">Desbloqueado</span>
                    </div>
                    
                    <div class="bg-cb-dark/50 rounded-xl p-4 text-center border border-cb-border opacity-40">
                        <i class="fas fa-fire text-red-500 text-4xl mb-2"></i>
                        <p class="text-sm text-gray-400">100 Problemas</p>
                        <span class="text-xs text-gray-500">Bloqueado</span>
                    </div>
                    
                    <div class="bg-cb-dark/50 rounded-xl p-4 text-center border border-cb-border opacity-40">
                        <i class="fas fa-brain text-purple-500 text-4xl mb-2"></i>
                        <p class="text-sm text-gray-400">Maestro DP</p>
                        <span class="text-xs text-gray-500">Bloqueado</span>
                    </div>
                    
                    <div class="bg-cb-dark/50 rounded-xl p-4 text-center border border-cb-border opacity-40">
                        <i class="fas fa-chart-line text-pink-500 text-4xl mb-2"></i>
                        <p class="text-sm text-gray-400">Ninja de Grafos</p>
                        <span class="text-xs text-gray-500">Bloqueado</span>
                    </div>
                </div>
            </div>

            {{-- 5. Actividad Reciente --}}
            <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-history text-cb-green mr-3"></i>
                    Actividad Reciente
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                        <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-cb-green text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-semibold">Resolviste "Two Sum Problem"</h4>
                            <p class="text-gray-400 text-sm">En 45ms - Weekly Challenge #46</p>
                        </div>
                        <span class="text-gray-400 text-sm">25 Nov 2025</span>
                    </div>

                    <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                        <div class="w-12 h-12 bg-green-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-cb-green text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-semibold">Resolviste "Longest Palindrome"</h4>
                            <p class="text-gray-400 text-sm">En 72ms - Weekly Challenge #46</p>
                        </div>
                        <span class="text-gray-400 text-sm">25 Nov 2025</span>
                    </div>

                    <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-400 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-semibold">Tiempo límite en "Binary Tree Traversal"</h4>
                            <p class="text-gray-400 text-sm">Graph Theory Challenge</p>
                        </div>
                        <span class="text-gray-400 text-sm">23 Nov 2025</span>
                    </div>

                    <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                        <div class="w-12 h-12 bg-red-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-400 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-semibold">Error en "Dynamic Programming Grid"</h4>
                            <p class="text-gray-400 text-sm">DP Sprint #12</p>
                        </div>
                        <span class="text-gray-400 text-sm">22 Nov 2025</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>