<x-app-layout>
    <div class="bg-gradient-to-b from-[#0f111a] via-[#0f111a] to-[#0a0c14] min-h-screen py-12 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Encabezado Mejorado con Gradiente --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#10b981]/10 via-transparent to-purple-500/10 blur-3xl"></div>
                <div class="relative bg-[#151a25] border border-[#2c3240] rounded-2xl p-8 shadow-2xl">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center shadow-lg shadow-[#10b981]/30">
                                    <i class="fas fa-trophy text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl md:text-4xl font-bold text-white">
                                        Mis Clasificaciones
                                    </h2>
                                    <p class="text-gray-400 text-sm mt-1">Torneos en los que estás participando y tus resultados</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Estadísticas Rápidas Mejoradas --}}
                        <div class="flex gap-4 w-full md:w-auto flex-wrap">
                            <div class="flex-1 md:flex-none md:min-w-[130px] px-4 py-4 bg-gradient-to-br from-[#10b981]/20 to-[#059669]/10 border border-[#10b981]/30 rounded-xl text-center shadow-lg shadow-[#10b981]/10 hover:shadow-[#10b981]/20 transition-all duration-300">
                                <span class="block text-[10px] text-[#10b981] uppercase font-bold tracking-wider mb-1">Participaciones</span>
                                <span class="text-white font-bold text-2xl">{{ $stats['my_participations'] ?? 0 }}</span>
                            </div>
                            <div class="flex-1 md:flex-none md:min-w-[130px] px-4 py-4 bg-gradient-to-br from-blue-500/20 to-blue-600/10 border border-blue-500/30 rounded-xl text-center shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transition-all duration-300">
                                <span class="block text-[10px] text-blue-300 uppercase font-bold tracking-wider mb-1">Activos</span>
                                <span class="text-white font-bold text-2xl">{{ $stats['total_events_active'] ?? 0 }}</span>
                            </div>
                            <div class="flex-1 md:flex-none md:min-w-[130px] px-4 py-4 bg-gradient-to-br from-purple-500/20 to-pink-500/10 border border-purple-500/30 rounded-xl text-center shadow-lg shadow-purple-500/10 hover:shadow-purple-500/20 transition-all duration-300">
                                <span class="block text-[10px] text-purple-300 uppercase font-bold tracking-wider mb-1">Finalizados</span>
                                <span class="text-white font-bold text-2xl">{{ $stats['total_events_finished'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Concursos Activos --}}
            @if($eventosActivos->count() > 0)
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-fire text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Concursos Activos</h2>
                            <p class="text-sm text-gray-400">Torneos en los que estás participando actualmente</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($eventosActivos as $contest)
                            <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-blue-500/50 rounded-2xl p-6 hover:border-blue-500 transition-all duration-500 group flex flex-col h-full shadow-xl hover:shadow-2xl hover:shadow-blue-500/20 hover:-translate-y-1">
                                
                                {{-- Efecto de brillo --}}
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                {{-- Header de la Tarjeta --}}
                                <div class="relative flex justify-between items-start mb-5">
                                    <span class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-blue-500/40 to-blue-600/40 border border-blue-500/50 text-blue-300 text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 animate-pulse">
                                        <i class="fas fa-circle text-xs"></i>
                                        En Progreso
                                    </span>
                                    <span class="text-xs font-bold px-3 py-1.5 rounded-lg shadow-md
                                        @if ($contest->difficulty == 'Difícil') 
                                            bg-gradient-to-r from-red-500/20 to-red-600/20 border border-red-500/50 text-red-400
                                        @elseif ($contest->difficulty == 'Medio') 
                                            bg-gradient-to-r from-yellow-500/20 to-orange-500/20 border border-yellow-500/50 text-yellow-400
                                        @else 
                                            bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/50 text-green-400
                                        @endif">
                                        <i class="fas fa-star mr-1"></i>
                                        {{ $contest->difficulty }}
                                    </span>
                                </div>

                                {{-- Título y Descripción --}}
                                <h3 class="relative text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors line-clamp-1">
                                    {{ $contest->name }}
                                </h3>
                                <p class="relative text-gray-400 text-sm mb-6 line-clamp-2 flex-grow leading-relaxed">
                                    {{ $contest->description }}
                                </p>

                                {{-- Datos --}}
                                <div class="relative border-t border-[#2c3240] pt-5 mt-auto space-y-4">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="flex items-center gap-2 text-sm bg-[#0f111a] px-3 py-2 rounded-lg border border-[#2c3240]">
                                            <i class="far fa-calendar-alt text-blue-400 text-base"></i>
                                            <span class="text-gray-300 text-xs font-medium">{{ \Carbon\Carbon::parse($contest->start_date)->format('d M') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm bg-[#0f111a] px-3 py-2 rounded-lg border border-[#2c3240]">
                                            <i class="fas fa-users text-blue-400 text-base"></i>
                                            <span class="text-gray-300 text-xs font-medium">{{ $contest->participants_count ?? 0 }} equipos</span>
                                        </div>
                                    </div>

                                    {{-- Botón de Acción --}}
                                    <a href="{{ route('concursos.show', $contest->id) }}" class="block w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-center rounded-xl text-sm font-bold transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 group/btn">
                                        <span class="flex items-center justify-center gap-2">
                                            Ver Detalles
                                            <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Concursos Finalizados --}}
            @if($eventosFinalizados->count() > 0)
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-trophy text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Concursos Finalizados</h2>
                            <p class="text-sm text-gray-400">Revisa los resultados de tus participaciones anteriores</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($eventosFinalizados as $contest)
                    <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-6 hover:border-[#10b981]/50 transition-all duration-500 group flex flex-col h-full shadow-xl hover:shadow-2xl hover:shadow-[#10b981]/10 hover:-translate-y-1">
                        
                        {{-- Efecto de brillo --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-[#10b981]/0 via-[#10b981]/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        {{-- Header de la Tarjeta --}}
                        <div class="relative flex justify-between items-start mb-5">
                            <span class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-gray-700/40 to-gray-800/40 border border-gray-600/50 text-gray-300 text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-400"></i>
                                Finalizado
                            </span>
                            <span class="text-xs font-bold px-3 py-1.5 rounded-lg shadow-md
                                @if ($contest->difficulty == 'Difícil') 
                                    bg-gradient-to-r from-red-500/20 to-red-600/20 border border-red-500/50 text-red-400
                                @elseif ($contest->difficulty == 'Medio') 
                                    bg-gradient-to-r from-yellow-500/20 to-orange-500/20 border border-yellow-500/50 text-yellow-400
                                @else 
                                    bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/50 text-green-400
                                @endif">
                                <i class="fas fa-star mr-1"></i>
                                {{ $contest->difficulty }}
                            </span>
                        </div>

                        {{-- Título y Descripción --}}
                        <h3 class="relative text-xl font-bold text-white mb-2 group-hover:text-[#10b981] transition-colors line-clamp-1">
                            {{ $contest->name }}
                        </h3>
                        <p class="relative text-gray-400 text-sm mb-6 line-clamp-2 flex-grow leading-relaxed">
                            {{ $contest->description }}
                        </p>

                        {{-- Datos --}}
                        <div class="relative border-t border-[#2c3240] pt-5 mt-auto space-y-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 text-sm bg-[#0f111a] px-3 py-2 rounded-lg border border-[#2c3240]">
                                    <i class="far fa-calendar-alt text-[#10b981] text-base"></i>
                                    <span class="text-gray-300 text-xs font-medium">{{ \Carbon\Carbon::parse($contest->start_date)->format('d M') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm bg-[#0f111a] px-3 py-2 rounded-lg border border-[#2c3240]">
                                    <i class="fas fa-users text-[#10b981] text-base"></i>
                                    <span class="text-gray-300 text-xs font-medium">{{ $contest->participants_count ?? 0 }} equipos</span>
                                </div>
                            </div>

                            {{-- Botón de Acción Premium --}}
                            <a href="{{ route('clasificacion.show', $contest->id) }}" class="block w-full py-3 bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white text-center rounded-xl text-sm font-bold transition-all duration-300 shadow-lg shadow-[#10b981]/20 hover:shadow-[#10b981]/40 group/btn">
                                <span class="flex items-center justify-center gap-2">
                                    Ver Clasificación
                                    <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif

            {{-- Estado vacío (si no hay activos ni finalizados) --}}
            @if($eventosActivos->count() == 0 && $eventosFinalizados->count() == 0)
                <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-16 text-center shadow-xl overflow-hidden">
                    {{-- Decoración de fondo --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-[#10b981]/5 via-transparent to-purple-500/5"></div>
                    
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#2c3240] to-[#1a1f2e] rounded-2xl flex items-center justify-center mx-auto mb-6 text-gray-500 shadow-xl">
                            <i class="fas fa-chart-line text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">No has participado en ningún torneo</h3>
                        <p class="text-gray-400 text-base mb-6 max-w-md mx-auto">Únete a los concursos disponibles y compite para ver tus resultados y rankings aquí.</p>
                        <a href="{{ route('concursos.public') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-[#10b981]/30 hover:shadow-[#10b981]/50 group">
                            <i class="fas fa-trophy"></i>
                            Ver Concursos Disponibles
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>