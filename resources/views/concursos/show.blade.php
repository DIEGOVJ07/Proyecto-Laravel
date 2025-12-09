<x-app-layout>
    {{-- FONDO PRINCIPAL OSCURO (HEX #0f111a) --}}
    <div class="bg-[#0f111a] min-h-screen py-10 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. ENCABEZADO --}}
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="space-y-3">
                    {{-- Badges de Estado y Dificultad --}}
                    <div class="flex items-center gap-2">
                        @if($event->status === 'Activo')
                            {{-- Badge Activo: Fondo Verde Sólido --}}
                            <span class="px-3 py-1 rounded-full border border-[#10b981] bg-[#10b981] text-white text-[11px] font-bold uppercase tracking-wider flex items-center gap-1.5 shadow-[0_0_10px_rgba(16,185,129,0.4)]">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Activo
                            </span>
                        @elseif($event->status === 'Finalizado')
                            <span class="px-3 py-1 rounded-full border border-gray-600 bg-gray-700/30 text-gray-400 text-[11px] font-bold uppercase tracking-wider">
                                Finalizado
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full border border-blue-500 bg-blue-500/10 text-blue-400 text-[11px] font-bold uppercase tracking-wider">
                                Próximamente
                            </span>
                        @endif

                        {{-- Badge Dificultad --}}
                        @if($event->difficulty === 'Difícil')
                            <span class="px-3 py-1 rounded-full border border-[#ef4444] bg-[#ef4444]/10 text-[#ef4444] text-[11px] font-bold uppercase tracking-wider">
                                Difícil
                            </span>
                        @elseif($event->difficulty === 'Medio')
                            <span class="px-3 py-1 rounded-full border border-[#f59e0b] bg-[#f59e0b]/10 text-[#f59e0b] text-[11px] font-bold uppercase tracking-wider">
                                Medio
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full border border-[#10b981] bg-[#10b981]/10 text-[#10b981] text-[11px] font-bold uppercase tracking-wider">
                                Fácil
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">{{ $event->name }}</h1>
                </div>

                <a href="{{ route('leaderboard.index') }}" class="px-4 py-2 rounded-lg border border-[#2c3240] bg-[#151a25] text-gray-400 text-sm font-medium hover:text-white hover:border-gray-500 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- COLUMNA IZQUIERDA (2/3) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- TARJETA DE DESCRIPCIÓN --}}
                    <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-8 shadow-lg">
                        <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                            <i class="fas fa-align-left text-[#10b981]"></i> Descripción
                        </h3>
                        
                        <p class="text-gray-400 text-sm leading-relaxed mb-8">
                            {{ $event->description }}
                        </p>

                        <div class="border-t border-[#2c3240] mb-6"></div>

                        {{-- Stats Row --}}
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">DURACIÓN</p>
                                <div class="flex items-center gap-2 text-white font-semibold">
                                    <i class="far fa-clock text-[#10b981]"></i> {{ $event->duration }}
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">PARTICIPANTES</p>
                                <div class="flex items-center gap-2 text-white font-semibold">
                                    <i class="fas fa-users text-[#10b981]"></i> {{ $event->participants }}
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">PREMIO</p>
                                <div class="flex items-center gap-2 text-[#10b981] font-bold text-lg">
                                    <i class="fas fa-trophy"></i> ${{ number_format($event->prize) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- GRID INFERIOR (Reglas y Stack) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Reglas --}}
                        <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-6">
                            <h4 class="text-white font-bold mb-3 text-sm uppercase flex items-center gap-2">
                                <i class="fas fa-gavel text-gray-400"></i> REGLAS
                            </h4>
                            <p class="text-gray-400 text-xs leading-relaxed">
                                {{ $event->rules ?? 'Debes resolver al menos 3 de 5 problemas. No se permite el uso de IA. El código debe ser original.' }}
                            </p>
                        </div>

                        {{-- Stack --}}
                        <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-6">
                            <h4 class="text-white font-bold mb-3 text-sm uppercase flex items-center gap-2">
                                <i class="fas fa-code text-gray-400"></i> STACK
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @if(is_array($event->languages))
                                    @foreach($event->languages as $lang)
                                        <span class="px-3 py-1.5 border border-[#2c3240] bg-[#0f111a] rounded text-xs text-gray-300 font-mono">
                                            {{ $lang }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 text-xs">Cualquiera</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA (1/3) - TARJETA DE ACCIÓN --}}
                <div>
                    <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-8 sticky top-8 h-fit shadow-xl">
                        
                        @if($event->status === 'Activo' || $event->status === 'Próximamente')
                            
                            @if($isRegistered)
                                {{-- VISTA: YA INSCRITO --}}
                                <div class="text-center py-4">
                                    <div class="w-20 h-20 rounded-full border-4 border-[#10b981] flex items-center justify-center mx-auto mb-6 bg-[#10b981]/10 shadow-[0_0_20px_rgba(16,185,129,0.2)]">
                                        <i class="fas fa-check text-[#10b981] text-4xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">¡Inscrito!</h3>
                                    <p class="text-gray-400 text-sm mb-8">Estás listo para competir.</p>
                                    
                                    <div class="bg-[#0f111a] border border-[#2c3240] rounded-lg p-4 text-left mb-6">
                                        <div class="flex justify-between items-center mb-3 pb-3 border-b border-[#2c3240]">
                                            <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">TU EQUIPO</span>
                                            <span class="text-white font-bold text-sm text-right truncate w-24">{{ $registration->team_name }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">CÓDIGO</span>
                                            <span class="text-[#f59e0b] font-mono font-bold tracking-widest">{{ $registration->team_code }}</span>
                                        </div>
                                    </div>

                                    <form action="{{ route('contests.cancel', $event->id) }}" method="POST" onsubmit="return confirm('¿Seguro?');">
                                        @csrf @method('DELETE')
                                        <button class="text-[#ef4444] hover:text-red-400 text-xs underline transition font-medium">
                                            Cancelar registro
                                        </button>
                                    </form>
                                </div>

                            @else
                                {{-- VISTA: FORMULARIO DE REGISTRO --}}
                                <div class="text-center mb-6">
                                    <h3 class="text-xl font-bold text-white">Registro</h3>
                                    <p class="text-xs text-gray-500 mt-1">Únete al desafío</p>
                                </div>

                                <form action="{{ route('contests.register', $event->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Nombre del Equipo</label>
                                        <input type="text" name="team_name" class="w-full bg-[#0f111a] border border-[#2c3240] rounded-lg text-white text-sm px-4 py-3 focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] outline-none placeholder-gray-600 transition" placeholder="Ej: CodeWarriors" required>
                                    </div>
                                    
                                    <div>
                                        <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Miembros (Max: {{ $event->max_team_members }})</label>
                                        <input type="number" name="max_members" value="1" min="{{ $event->min_team_members }}" max="{{ $event->max_team_members }}" class="w-full bg-[#0f111a] border border-[#2c3240] rounded-lg text-white text-sm px-4 py-3 focus:border-[#10b981] outline-none transition">
                                    </div>

                                    <div class="flex items-center gap-2 py-2">
                                        <input type="checkbox" name="is_public" id="is_public" class="rounded bg-[#0f111a] border-[#2c3240] text-[#10b981] focus:ring-0 w-4 h-4">
                                        <label for="is_public" class="text-xs text-gray-400 cursor-pointer select-none">Hacer equipo público</label>
                                    </div>

                                    {{-- BOTÓN VERDE BRILLANTE --}}
                                    <button type="submit" class="w-full bg-[#10b981] hover:bg-[#059669] text-white font-bold py-3.5 rounded-lg transition-all duration-200 shadow-lg shadow-[#10b981]/20 text-sm uppercase tracking-wide">
                                        Inscribirse Ahora
                                    </button>
                                </form>
                            @endif

                        @else
                            {{-- ESTADO: FINALIZADO --}}
                            <div class="py-8 text-center">
                                <div class="w-20 h-20 bg-gray-800/50 rounded-full flex items-center justify-center mx-auto text-4xl mb-6 text-gray-500 border border-gray-700">
                                    <i class="fas fa-flag-checkered"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">Finalizado</h3>
                                <p class="text-gray-500 text-sm mb-6">El evento ha concluido.</p>
                                
                                {{-- ENLACE AL RANKING --}}
                                <a href="{{ route('leaderboard.show', $event->id) }}" class="w-full block py-3 bg-[#2c3240] hover:bg-gray-700 text-white rounded-lg text-sm font-bold transition text-center border border-gray-600 hover:border-gray-500">
                                    Ver Resultados &darr;
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>