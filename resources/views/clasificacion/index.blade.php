<x-app-layout>
    <div class="bg-[#0f111a] min-h-screen py-10 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Encabezado --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-[#2c3240] pb-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
                        <i class="fas fa-trophy text-[#10b981]"></i> Torneos Finalizados
                    </h2>
                    <p class="text-gray-400 text-sm">Explora los resultados y rankings de competencias anteriores.</p>
                </div>
                
                {{-- Estadísticas Rápidas --}}
                <div class="flex gap-4">
                    <div class="px-4 py-2 bg-[#151a25] border border-[#2c3240] rounded-lg text-center">
                        <span class="block text-xs text-gray-500 uppercase font-bold tracking-wider">Torneos</span>
                        <span class="text-white font-bold text-lg">{{ $stats['total_events_finished'] ?? 0 }}</span>
                    </div>
                    <div class="px-4 py-2 bg-[#151a25] border border-[#2c3240] rounded-lg text-center">
                        <span class="block text-xs text-gray-500 uppercase font-bold tracking-wider">Usuarios</span>
                        <span class="text-white font-bold text-lg">{{ $stats['total_users'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Lista de Torneos (Grid de Tarjetas Dark Neon) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($eventosFinalizados as $contest)
                    <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-6 hover:border-[#10b981]/50 transition duration-300 group flex flex-col h-full shadow-lg">
                        
                        {{-- Header de la Tarjeta --}}
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 rounded-full border border-gray-600 bg-gray-700/20 text-gray-400 text-[10px] font-bold uppercase tracking-wider">
                                Finalizado
                            </span>
                            <span class="text-xs font-bold px-2 py-1 rounded border 
                                @if ($contest->difficulty == 'Difícil') border-red-900/50 text-red-400
                                @elseif ($contest->difficulty == 'Medio') border-yellow-900/50 text-yellow-500
                                @else border-green-900/50 text-green-400
                                @endif">
                                {{ $contest->difficulty }}
                            </span>
                        </div>

                        {{-- Título y Descripción --}}
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#10b981] transition-colors">
                            {{ $contest->name }}
                        </h3>
                        <p class="text-gray-400 text-xs mb-6 line-clamp-2 flex-grow">
                            {{ $contest->description }}
                        </p>

                        {{-- Datos --}}
                        <div class="border-t border-[#2c3240] pt-4 mt-auto space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <div class="flex items-center gap-2 text-gray-400">
                                    <i class="far fa-calendar-alt text-[#10b981]"></i>
                                    <span>{{ \Carbon\Carbon::parse($contest->start_date)->format('d M, Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-400">
                                    <i class="fas fa-users text-[#10b981]"></i>
                                    <span>{{ $contest->participants_count ?? 0 }}</span>
                                </div>
                            </div>

                            {{-- Botón de Acción --}}
                            <a href="{{ route('leaderboard.show', $contest->id) }}" class="block w-full py-2 bg-[#2c3240] hover:bg-[#10b981] hover:text-white text-gray-300 text-center rounded-lg text-sm font-bold transition-all duration-300 border border-gray-700 hover:border-[#10b981] shadow-md">
                                Ver Ranking Oficial &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-12 text-center">
                            <div class="w-16 h-16 bg-[#2c3240] rounded-full flex items-center justify-center mx-auto mb-4 text-gray-500">
                                <i class="fas fa-inbox text-3xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">No hay torneos finalizados</h3>
                            <p class="text-gray-500 text-sm">Los resultados de los concursos aparecerán aquí una vez que terminen.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>