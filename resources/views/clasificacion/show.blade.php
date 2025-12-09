<x-app-layout>
    {{-- FONDO OSCURO --}}
    <div class="bg-[#0f111a] min-h-screen py-10 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. ENCABEZADO --}}
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full border border-gray-600 bg-gray-700/30 text-gray-400 text-[11px] font-bold uppercase tracking-wider">
                            FINALIZADO
                        </span>
                        <span class="px-3 py-1 rounded-full border border-[#f59e0b] bg-[#f59e0b]/10 text-[#f59e0b] text-[11px] font-bold uppercase tracking-wider">
                            {{ $event->difficulty }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">
                        Resultados: {{ $event->name }}
                    </h1>
                </div>

                <a href="{{ route('leaderboard.index') }}" class="px-4 py-2 border border-[#2c3240] rounded-lg text-gray-400 hover:text-white hover:border-gray-500 transition text-sm font-medium flex items-center gap-2 bg-[#151a25]">
                    <i class="fas fa-arrow-left"></i> Volver a Torneos
                </a>
            </div>

            {{-- 2. HALL OF FAME (TOP 3 EQUIPOS) --}}
            @if($hallOfFame->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($hallOfFame as $index => $entry)
                        <div class="bg-[#151a25] rounded-xl p-8 border relative overflow-hidden text-center transform hover:-translate-y-1 transition duration-300
                            @if($index == 0) border-yellow-500/30 shadow-[0_0_30px_rgba(234,179,8,0.15)] order-1 md:order-2 md:-mt-4 z-10
                            @elseif($index == 1) border-gray-400/30 order-2 md:order-1
                            @else border-orange-500/30 order-3 md:order-3 @endif">
                            
                            <div class="text-5xl mb-4 filter drop-shadow-md">
                                @if($index == 0) 🥇 @elseif($index == 1) 🥈 @else 🥉 @endif
                            </div>
                            
                            <h4 class="text-xl font-bold text-white truncate mb-1">{{ $entry->team_name }}</h4>
                            {{-- Lee el nombre del líder desde la relación teamLeader --}}
                            <p class="text-xs text-gray-500 mb-4">Líder: {{ $entry->teamLeader->name ?? 'N/A' }}</p>
                            
                            <div class="inline-block bg-[#0f111a] rounded-lg px-4 py-2 border border-[#2c3240]">
                                {{-- Lee el score desde la columna score --}}
                                <p class="text-[#10b981] font-mono font-bold text-lg">{{ number_format($entry->score) }} <span class="text-xs text-gray-500">PTS</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- 3. TABLA DE POSICIONES COMPLETA --}}
            <div class="bg-[#151a25] border border-[#2c3240] rounded-xl overflow-hidden shadow-xl">
                <div class="px-6 py-4 border-b border-[#2c3240] flex justify-between items-center bg-[#1a202c]">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fas fa-list-ol text-[#10b981]"></i> Ranking por Equipos
                    </h3>
                    <span class="text-xs text-gray-500 bg-[#0f111a] px-3 py-1 rounded-full border border-[#2c3240]">
                        {{ $ranking->count() }} Equipos clasificados
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-[#0f111a] text-gray-500 text-[10px] uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Rango</th>
                                <th class="px-6 py-4">Nombre del Equipo</th>
                                <th class="px-6 py-4">Líder / Integrante</th>
                                <th class="px-6 py-4 text-right">Puntos</th>
                                <th class="px-6 py-4 text-right">Estado</th> {{-- Cambiado a Estado --}}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#2c3240] text-sm text-gray-300">
                            @foreach($ranking as $index => $entry)
                                <tr class="hover:bg-[#2c3240]/30 transition group">
                                    {{-- Rango --}}
                                    <td class="px-6 py-4 font-mono">
                                        @if($index < 3)
                                            <span class="text-yellow-500 font-bold text-lg">#{{ $index + 1 }}</span>
                                        @else
                                            <span class="text-gray-600 font-bold">#{{ $index + 1 }}</span>
                                        @endif
                                    </td>

                                    {{-- Equipo --}}
                                    <td class="px-6 py-4 font-bold text-white group-hover:text-[#10b981] transition-colors">
                                        {{ $entry->team_name }}
                                    </td>

                                    {{-- Usuario --}}
                                    <td class="px-6 py-4 text-gray-400 text-xs">
                                        {{ $entry->teamLeader->name ?? 'N/A' }}
                                    </td>

                                    {{-- Puntos --}}
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-[#10b981] font-mono font-bold text-base">
                                            {{ number_format($entry->score) }}
                                        </span>
                                    </td>

                                    {{-- Estado --}}
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-[10px] font-bold px-2 py-1 rounded border 
                                            @if($entry->status == 'qualified') border-[#10b981] text-[#10b981] 
                                            @else border-gray-600 text-gray-400 @endif">
                                            {{ $entry->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>