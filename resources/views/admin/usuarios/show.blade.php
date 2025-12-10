<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-user mr-2 text-purple-400"></i>
                Detalles del Usuario
            </h2>
            <div class="flex gap-3">
                @if(!$user->hasRole('super_admin'))
                    <a href="{{ route('admin.usuarios.edit', $user) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-500 transition-all text-sm font-medium">
                        <i class="fas fa-edit mr-2"></i>
                        Editar
                    </a>
                @endif
                <a href="{{ route('admin.usuarios.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Información principal -->
            <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-8 mb-6">
                <div class="flex items-start gap-6">
                    <div class="flex-shrink-0 h-24 w-24 bg-cb-green/20 rounded-full flex items-center justify-center">
                        @if($user->hasRole('super_admin'))
                            <i class="fas fa-shield-halved text-purple-400 text-4xl"></i>
                        @elseif($user->hasRole('admin'))
                            <i class="fas fa-crown text-yellow-400 text-4xl"></i>
                        @elseif($user->hasRole('juez'))
                            <i class="fas fa-gavel text-blue-400 text-4xl"></i>
                        @else
                            <i class="fas fa-user text-gray-400 text-4xl"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $user->name }}</h3>
                        <p class="text-gray-400 mb-4">{{ $user->email }}</p>
                        
                        <div class="flex items-center gap-4">
                            @if($user->hasRole('super_admin'))
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">
                                    <i class="fas fa-shield-halved mr-2"></i> Super Administrador
                                </span>
                            @elseif($user->hasRole('admin'))
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                    <i class="fas fa-crown mr-2"></i> Administrador
                                </span>
                            @elseif($user->hasRole('juez'))
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                    <i class="fas fa-gavel mr-2"></i> Juez
                                </span>
                            @else
                                <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-500/20 text-gray-400 border border-gray-500/30">
                                    <i class="fas fa-user mr-2"></i> Usuario
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Concursos</p>
                            <p class="text-3xl font-bold text-white">{{ $user->contestRegistrations()->count() }}</p>
                        </div>
                        <i class="fas fa-trophy text-4xl text-gray-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Puntos</p>
                            <p class="text-3xl font-bold text-cb-green">{{ $user->leaderboard->points ?? 0 }}</p>
                        </div>
                        <i class="fas fa-star text-4xl text-gray-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Ranking</p>
                            <p class="text-3xl font-bold text-yellow-400">#{{ $user->leaderboard->rank ?? '-' }}</p>
                        </div>
                        <i class="fas fa-medal text-4xl text-gray-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Victorias</p>
                            <p class="text-3xl font-bold text-purple-400">{{ $user->leaderboard && $user->leaderboard->is_winner ? 1 : 0 }}</p>
                        </div>
                        <i class="fas fa-crown text-4xl text-gray-600"></i>
                    </div>
                </div>
            </div>

            <!-- Información de cuenta -->
            <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6 mb-6">
                <h4 class="text-lg font-semibold text-white mb-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    Información de la Cuenta
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Fecha de registro</p>
                        <p class="text-white">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Última actualización</p>
                        <p class="text-white">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                        <p class="text-xs text-gray-500">{{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Concursos participados -->
            @if($user->contestRegistrations()->count() > 0)
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6">
                    <h4 class="text-lg font-semibold text-white mb-4">
                        <i class="fas fa-trophy mr-2"></i>
                        Concursos Participados ({{ $user->contestRegistrations()->count() }})
                    </h4>
                    <div class="space-y-3">
                        @foreach($user->contestRegistrations()->with('contest')->latest()->take(5)->get() as $registration)
                            <div class="bg-cb-dark rounded-lg p-4 border border-cb-border">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 class="text-white font-semibold">{{ $registration->contest->name }}</h5>
                                        <p class="text-sm text-gray-400">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $registration->contest->start_date->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        @if($registration->score !== null)
                                            <p class="text-2xl font-bold text-cb-green">{{ $registration->score }}</p>
                                            <p class="text-xs text-gray-400">puntos</p>
                                        @else
                                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs">
                                                Pendiente
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
