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
                            <i class="fas fa-trophy text-3xl text-blue-400"></i>
                            <span class="text-4xl font-bold text-white">{{ $stats['total_contests'] }}</span>
                        </div>
                        <p class="text-gray-400">Concursos Participados</p>
                    </div>

                    <div class="bg-cb-dark/50 p-6 rounded-xl border border-cb-border">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-award text-3xl text-yellow-400"></i>
                            <span class="text-4xl font-bold text-white">{{ $stats['contests_won'] }}</span>
                        </div>
                        <p class="text-gray-400">Concursos Destacados</p>
                    </div>

                    <div class="bg-cb-dark/50 p-6 rounded-xl border border-cb-border">
                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-star text-3xl text-cb-green"></i>
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
                                <i class="fas fa-user-tag mr-2"></i>
                                Rol:
                            </div>
                            <div class="flex-1">
                                @if($user->hasRole('super_admin'))
                                    <span class="px-3 py-1 bg-purple-500/10 text-purple-400 rounded-lg text-sm font-medium">
                                        <i class="fas fa-shield-halved mr-1"></i> Super Admin
                                    </span>
                                @elseif($user->hasRole('admin'))
                                    <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 rounded-lg text-sm font-medium">
                                        <i class="fas fa-crown mr-1"></i> Admin
                                    </span>
                                @elseif($user->hasRole('juez'))
                                    <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-lg text-sm font-medium">
                                        <i class="fas fa-gavel mr-1"></i> Juez
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gray-500/10 text-gray-400 rounded-lg text-sm font-medium">
                                        <i class="fas fa-user mr-1"></i> Usuario
                                    </span>
                                @endif
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
                                <i class="fas fa-tasks mr-2"></i>
                                Participaciones:
                            </div>
                            <div class="flex-1 text-white font-medium">
                                {{ $stats['total_contests'] }} concursos
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-32 text-gray-400">
                                <i class="fas fa-check-circle mr-2"></i>
                                Estado:
                            </div>
                            <div class="flex-1">
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-lg text-sm font-medium">
                                    <i class="fas fa-circle text-green-400 text-xs mr-1"></i> Activo
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Estadísticas de Concursos --}}
            <div class="grid lg:grid-cols-2 gap-6">
                
                {{-- Concursos Destacados --}}
                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-trophy text-yellow-400 mr-3"></i>
                        Mejores Resultados
                    </h3>

                    @if($wonContests->count() > 0)
                        <div class="space-y-4">
                            @foreach($wonContests as $registration)
                                <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border hover:border-cb-green/50 transition-all">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-medal text-yellow-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold">{{ $registration->contest->name }}</h4>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-calendar mr-1"></i>
                                                {{ $registration->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        @if($registration->score !== null)
                                            <span class="text-xl font-bold text-cb-green">{{ $registration->score }}</span>
                                            <p class="text-xs text-gray-400">puntos</p>
                                        @else
                                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs">Pendiente</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-trophy text-6xl text-gray-600 mb-4"></i>
                            <p class="text-gray-400">Aún no tienes concursos destacados</p>
                            <p class="text-sm text-gray-500 mt-2">¡Participa y logra buenos resultados!</p>
                        </div>
                    @endif
                </div>

                {{-- Concursos Recientes --}}
                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-list text-blue-400 mr-3"></i>
                        Participaciones Recientes
                    </h3>

                    @if($recentContests->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentContests as $registration)
                                <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border hover:border-blue-500/50 transition-all">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-code text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold">{{ $registration->contest->name }}</h4>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-users mr-1"></i>
                                                {{ $registration->team_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        @if($registration->score !== null)
                                            <span class="text-lg font-bold text-white">{{ $registration->score }}</span>
                                            <p class="text-xs text-gray-400">pts</p>
                                        @else
                                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-xs">
                                                En proceso
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-clipboard-list text-6xl text-gray-600 mb-4"></i>
                            <p class="text-gray-400">No has participado en concursos</p>
                            <p class="text-sm text-gray-500 mt-2">¡Inscríbete en tu primer concurso!</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 4. Resumen de Equipos --}}
            @if($recentContests->count() > 0)
            <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-users text-cb-green mr-3"></i>
                    Equipos Registrados
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($recentContests as $registration)
                        <div class="bg-cb-dark/50 rounded-xl p-4 border border-cb-border hover:border-cb-green/50 transition-all">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h4 class="text-white font-semibold mb-1">{{ $registration->team_name }}</h4>
                                    <p class="text-sm text-gray-400">{{ $registration->contest->name }}</p>
                                </div>
                                @if($registration->is_team_leader)
                                    <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded text-xs">
                                        <i class="fas fa-crown"></i> Líder
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">
                                    <i class="fas fa-user-friends mr-1"></i>
                                    {{ $registration->current_members ?? $registration->team_size }} miembros
                                </span>
                                @if($registration->score !== null)
                                    <span class="text-cb-green font-bold">{{ $registration->score }} pts</span>
                                @else
                                    <span class="text-blue-400">En curso</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- 5. Información Adicional --}}
            <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-chart-pie text-cb-green mr-3"></i>
                    Resumen General
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-white mb-2">{{ $stats['total_contests'] }}</div>
                        <p class="text-gray-400">Concursos Totales</p>
                        <div class="mt-2 h-2 bg-cb-dark rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-4xl font-bold text-yellow-400 mb-2">{{ $stats['contests_won'] }}</div>
                        <p class="text-gray-400">Resultados Destacados</p>
                        <div class="mt-2 h-2 bg-cb-dark rounded-full overflow-hidden">
                            <div class="h-full bg-yellow-500" style="width: {{ $stats['total_contests'] > 0 ? ($stats['contests_won'] / $stats['total_contests'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cb-green mb-2">{{ number_format($stats['total_points']) }}</div>
                        <p class="text-gray-400">Puntos Acumulados</p>
                        <div class="mt-2 h-2 bg-cb-dark rounded-full overflow-hidden">
                            <div class="h-full bg-cb-green" style="width: {{ min(($stats['total_points'] / 100), 100) }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                    <div class="flex items-center gap-3 text-gray-300">
                        <i class="fas fa-info-circle text-blue-400"></i>
                        <p class="text-sm">
                            <strong class="text-white">Tip:</strong> Participa en más concursos para mejorar tu ranking y acumular puntos. 
                            ¡La práctica constante te llevará al top!
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>