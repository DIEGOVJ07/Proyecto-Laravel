<x-app-layout>
    <div class="bg-gradient-to-b from-[#0f111a] via-[#0f111a] to-[#0a0c14] min-h-screen py-12 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Encabezado Mejorado --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 via-transparent to-[#10b981]/10 blur-3xl"></div>
                <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-8 shadow-2xl">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                                <i class="fas fa-globe text-white text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-white mb-1">Equipos Públicos</h1>
                                <p class="text-gray-400">{{ $contest->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="px-6 py-4 bg-gradient-to-br from-[#10b981]/20 to-[#059669]/10 border border-[#10b981]/30 rounded-xl text-center shadow-lg">
                                <div class="text-3xl font-bold text-white">{{ $teams->count() }}</div>
                                <p class="text-[#10b981] text-xs font-bold uppercase tracking-wider mt-1">Equipos Disponibles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($teams->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($teams as $team)
                        <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] rounded-2xl shadow-2xl border border-[#2c3240] hover:border-purple-500/50 transition-all duration-500 overflow-hidden group hover:-translate-y-1">
                            {{-- Efecto de brillo --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/0 via-purple-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Header --}}
                            <div class="relative bg-gradient-to-r from-purple-500/20 to-transparent p-6 border-b border-[#2c3240]">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl font-bold text-white group-hover:text-purple-300 transition-colors flex-1 pr-2">{{ $team->team_name }}</h3>
                                    <span class="px-3 py-1.5 bg-gradient-to-r from-[#10b981]/20 to-[#059669]/10 text-[#10b981] border border-[#10b981]/50 rounded-lg text-xs font-bold shadow-md">
                                        {{ $team->team_code }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm">
                                    <span class="flex items-center gap-2 text-gray-300">
                                        <i class="fas fa-users text-purple-400"></i>
                                        <span class="font-medium">{{ $team->current_members }}/{{ $team->max_members }}</span>
                                    </span>
                                    <span class="flex items-center gap-2 px-3 py-1 bg-purple-500/20 text-purple-300 rounded-lg border border-purple-500/30">
                                        <i class="fas fa-globe text-xs"></i>
                                        <span class="text-xs font-bold">Público</span>
                                    </span>
                                </div>
                            </div>

                            {{-- Contenido --}}
                            <div class="relative p-6 space-y-5">
                                {{-- Líder --}}
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-3">Líder del Equipo</p>
                                    <div class="flex items-center gap-3 bg-[#0f111a] p-3 rounded-xl border border-[#2c3240]">
                                        <div class="w-12 h-12 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                            {{ substr($team->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-white font-bold">{{ $team->user->name }}</p>
                                            <p class="text-gray-400 text-xs flex items-center gap-1">
                                                <i class="fas fa-crown text-yellow-500"></i>
                                                Creador
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Miembros --}}
                                @if($team->members->count() > 0)
                                    <div>
                                        <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-3">
                                            Miembros <span class="text-purple-400">({{ $team->members->count() }})</span>
                                        </p>
                                        <div class="flex -space-x-3">
                                            @foreach($team->members->take(4) as $member)
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white text-sm font-bold border-2 border-[#151a25] shadow-lg hover:scale-110 transition-transform cursor-pointer" title="{{ $member->user->name }}">
                                                    {{ substr($member->user->name, 0, 1) }}
                                                </div>
                                            @endforeach
                                            @if($team->members->count() > 4)
                                                <div class="w-10 h-10 bg-gradient-to-br from-gray-700 to-gray-800 rounded-xl flex items-center justify-center text-white text-xs font-bold border-2 border-[#151a25] shadow-lg">
                                                    +{{ $team->members->count() - 4 }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- Espacios disponibles --}}
                                <div class="bg-gradient-to-r from-[#10b981]/10 to-transparent border border-[#10b981]/30 rounded-xl p-4">
                                    <p class="text-[#10b981] text-sm font-bold flex items-center gap-2">
                                        <i class="fas fa-circle-info"></i>
                                        {{ $team->max_members - $team->current_members }} espacio(s) disponible(s)
                                    </p>
                                </div>

                                {{-- Botón de unirse --}}
                                @if(!$team->hasUser(Auth::id()))
                                    <form method="POST" action="{{ route('equipos.join', $team->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-[#10b981]/30 hover:shadow-[#10b981]/50 group/btn">
                                            <span class="flex items-center justify-center gap-2">
                                                <i class="fas fa-user-plus group-hover/btn:scale-110 transition-transform"></i>
                                                Unirme al Equipo
                                                <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                            </span>
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gradient-to-r from-green-500/20 to-transparent text-green-400 border-2 border-green-500/50 font-bold py-3.5 px-4 rounded-xl cursor-not-allowed">
                                        <span class="flex items-center justify-center gap-2">
                                            <i class="fas fa-check-circle"></i>
                                            Ya eres miembro de este equipo
                                        </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Sin equipos disponibles --}}
                <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-20 text-center shadow-xl overflow-hidden">
                    {{-- Decoración de fondo --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 via-transparent to-[#10b981]/5"></div>
                    
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#2c3240] to-[#1a1f2e] rounded-2xl flex items-center justify-center mx-auto mb-6 text-gray-500 shadow-2xl">
                            <i class="fas fa-users-slash text-5xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-4">
                            No hay equipos públicos disponibles
                        </h3>
                        <p class="text-gray-400 text-lg mb-8 max-w-md mx-auto">
                            Sé el primero en crear un equipo público para este concurso
                        </p>
                        <a href="{{ route('concursos.show', $contest->id) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg shadow-[#10b981]/30 hover:shadow-[#10b981]/50 group">
                            <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
                            Crear Equipo Público
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endif

            {{-- Volver --}}
            <div class="flex justify-center">
                <a href="{{ route('concursos.show', $contest->id) }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#151a25] hover:bg-[#1a202c] border-2 border-[#2c3240] hover:border-[#10b981] text-gray-300 hover:text-white font-bold rounded-xl transition-all duration-300 group">
                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Volver al Concurso
                </a>
            </div>

        </div>
    </div>
</x-app-layout>