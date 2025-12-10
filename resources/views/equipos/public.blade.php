<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-globe text-cb-green mr-2"></i>
            Equipos Públicos - {{ $contest->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Información del Concurso --}}
            <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $contest->name }}</h3>
                        <p class="text-gray-400">{{ $contest->description }}</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cb-green">{{ $teams->count() }}</div>
                        <p class="text-gray-400 text-sm">Equipos Disponibles</p>
                    </div>
                </div>
            </div>

            @if($teams->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($teams as $team)
                        <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition overflow-hidden">
                            {{-- Header --}}
                            <div class="bg-gradient-to-r from-cb-green/20 to-cb-card p-6 border-b border-cb-border">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xl font-bold text-white">{{ $team->team_name }}</h3>
                                    <span class="px-3 py-1 bg-cb-green/20 text-cb-green border border-cb-green rounded-full text-xs font-bold">
                                        {{ $team->team_code }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-gray-400">
                                    <span>
                                        <i class="fas fa-users text-cb-green mr-1"></i>
                                        {{ $team->current_members }}/{{ $team->max_members }}
                                    </span>
                                    <span>
                                        <i class="fas fa-globe text-cb-green mr-1"></i>
                                        Público
                                    </span>
                                </div>
                            </div>

                            {{-- Líder --}}
                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-gray-400 text-xs mb-2">Líder del Equipo</p>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($team->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">{{ $team->user->name }}</p>
                                            <p class="text-gray-400 text-xs">Creador</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Miembros --}}
                                @if($team->members->count() > 0)
                                    <div>
                                        <p class="text-gray-400 text-xs mb-2">Miembros ({{ $team->members->count() }})</p>
                                        <div class="flex -space-x-2">
                                            @foreach($team->members->take(3) as $member)
                                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold border-2 border-cb-card" title="{{ $member->user->name }}">
                                                    {{ substr($member->user->name, 0, 1) }}
                                                </div>
                                            @endforeach
                                            @if($team->members->count() > 3)
                                                <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white text-xs font-bold border-2 border-cb-card">
                                                    +{{ $team->members->count() - 3 }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- Espacios disponibles --}}
                                <div class="bg-blue-500/10 border border-blue-500 rounded-lg p-3">
                                    <p class="text-blue-400 text-sm font-medium">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        {{ $team->max_members - $team->current_members }} espacio(s) disponible(s)
                                    </p>
                                </div>

                                {{-- Botón de unirse --}}
                                @if(!$team->hasUser(Auth::id()))
                                    <form method="POST" action="{{ route('equipos.join', $team->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Unirme
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-green-500/20 text-green-400 border border-green-500 font-bold py-2 px-4 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Ya eres miembro
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Sin equipos disponibles --}}
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users-slash text-cb-green text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">
                        No hay equipos públicos disponibles
                    </h3>
                    <p class="text-gray-400 mb-8">
                        Sé el primero en crear un equipo público para este concurso
                    </p>
                    <a href="{{ route('concursos.show', $contest->id) }}" class="inline-block bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>
                        Crear Equipo
                    </a>
                </div>
            @endif

            {{-- Volver --}}
            <div class="text-center">
                <a href="{{ route('concursos.show', $contest->id) }}" class="inline-block px-6 py-3 bg-cb-border hover:bg-gray-600 text-white font-bold rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al Concurso
                </a>
            </div>

        </div>
    </div>
</x-app-layout>