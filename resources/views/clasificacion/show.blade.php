<x-app-layout>
    {{-- FONDO OSCURO CON GRADIENTE --}}
    <div class="bg-gradient-to-b from-[#0f111a] via-[#0f111a] to-[#0a0c14] min-h-screen py-12 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- 1. ENCABEZADO PREMIUM --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#10b981]/10 via-transparent to-purple-500/10 blur-3xl"></div>
                <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-8 shadow-2xl">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <div class="space-y-4 flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="px-4 py-2 rounded-xl border border-gray-600 bg-gradient-to-r from-gray-700/40 to-gray-800/40 text-gray-300 text-xs font-bold uppercase tracking-wider flex items-center gap-2 shadow-lg">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                    FINALIZADO
                                </span>
                                <span class="px-4 py-2 rounded-xl border border-[#f59e0b] bg-gradient-to-r from-[#f59e0b]/20 to-[#f59e0b]/10 text-[#f59e0b] text-xs font-bold uppercase tracking-wider flex items-center gap-2 shadow-lg">
                                    <i class="fas fa-star"></i>
                                    {{ $event->difficulty }}
                                </span>
                            </div>
                            <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">
                                {{ $event->name }}
                            </h1>
                            <p class="text-gray-400 text-sm">Clasificación Oficial del Torneo</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 lg:items-start">
                            {{-- BOTÓN CERTIFICADO --}}
                            @if(isset($isRegistered) && $isRegistered && isset($registration) && $registration->status === 'qualified')
                                <form action="{{ route('concursos.certificate', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white text-sm font-bold shadow-xl shadow-[#10b981]/30 hover:shadow-[#10b981]/50 flex items-center gap-2 transition-all duration-300 transform hover:scale-105 group">
                                        <i class="fas fa-certificate group-hover:rotate-12 transition-transform"></i> 
                                        Obtener Certificado
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('clasificacion.index') }}" class="px-6 py-3 border-2 border-[#2c3240] rounded-xl text-gray-400 hover:text-white hover:border-[#10b981] transition-all duration-300 text-sm font-bold flex items-center gap-2 bg-[#151a25] hover:bg-[#1a202c] group">
                                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MENSAJES FLASH --}}
            @if(session('success'))
                <div class="bg-[#10b981]/10 border border-[#10b981] text-[#10b981] px-4 py-3 rounded-lg flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg flex items-center gap-2">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                </div>
            @endif

            {{-- 2. HALL OF FAME MEJORADO (TOP 3 EQUIPOS) --}}
            @if($hallOfFame->count() > 0)
                <div class="relative">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <i class="fas fa-trophy text-yellow-500"></i>
                        Hall of Fame
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($hallOfFame as $index => $entry)
                            <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] rounded-2xl p-8 border overflow-hidden text-center transform hover:-translate-y-2 transition-all duration-500 group
                                @if($index == 0) 
                                    border-yellow-500/50 shadow-[0_0_40px_rgba(234,179,8,0.25)] hover:shadow-[0_0_60px_rgba(234,179,8,0.35)] order-1 md:order-2 md:-mt-6 md:scale-110 z-10
                                @elseif($index == 1) 
                                    border-gray-400/50 shadow-[0_0_30px_rgba(156,163,175,0.15)] hover:shadow-[0_0_40px_rgba(156,163,175,0.25)] order-2 md:order-1
                                @else 
                                    border-orange-500/50 shadow-[0_0_30px_rgba(249,115,22,0.15)] hover:shadow-[0_0_40px_rgba(249,115,22,0.25)] order-3 md:order-3
                                @endif">
                                
                                {{-- Efecto de brillo --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-transparent via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                {{-- Posición --}}
                                <div class="relative mb-4">
                                    <div class="text-7xl mb-2 filter drop-shadow-2xl animate-pulse">
                                        @if($index == 0) 🥇 @elseif($index == 1) 🥈 @else 🥉 @endif
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-wider
                                        @if($index == 0) text-yellow-500
                                        @elseif($index == 1) text-gray-400
                                        @else text-orange-500 @endif">
                                        {{ $index == 0 ? 'Campeón' : ($index == 1 ? 'Subcampeón' : 'Tercer Lugar') }}
                                    </span>
                                </div>
                                
                                {{-- Info del equipo --}}
                                <h4 class="relative text-2xl font-bold text-white mb-2 truncate group-hover:text-[#10b981] transition-colors">
                                    {{ $entry->team_name }}
                                </h4>
                                <p class="relative text-xs text-gray-400 mb-6 flex items-center justify-center gap-2">
                                    <i class="fas fa-user-circle"></i>
                                    {{ $entry->user_name ?? $entry->teamLeader->name ?? 'N/A' }}
                                </p>
                                
                                {{-- Puntos --}}
                                <div class="relative inline-block bg-gradient-to-br from-[#0f111a] to-[#151a25] rounded-xl px-6 py-4 border-2 shadow-xl
                                    @if($index == 0) border-yellow-500/50
                                    @elseif($index == 1) border-gray-400/50
                                    @else border-orange-500/50 @endif">
                                    <p class="text-[#10b981] font-mono font-bold text-2xl flex items-baseline justify-center gap-2">
                                        {{ number_format($entry->score ?? $entry->points) }}
                                        <span class="text-xs text-gray-500 font-bold">PUNTOS</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- 3. TABLA DE POSICIONES MODERNA --}}
            <div class="relative">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <i class="fas fa-list-ol text-[#10b981]"></i>
                    Ranking Completo
                </h2>
                <div class="bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl overflow-hidden shadow-2xl">
                    <div class="px-8 py-5 border-b border-[#2c3240] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-gradient-to-r from-[#1a202c] to-[#151a25]">
                        <h3 class="text-lg font-bold text-white flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-ranking-star text-white"></i>
                            </div>
                            Clasificación por Equipos
                        </h3>
                        <span class="text-xs text-gray-300 bg-[#0f111a] px-4 py-2 rounded-xl border border-[#2c3240] font-bold shadow-md">
                            <i class="fas fa-users mr-1 text-[#10b981]"></i>
                            {{ $ranking->count() }} Equipos
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gradient-to-r from-[#0f111a] to-[#151a25] text-gray-400 text-xs uppercase font-bold tracking-wider">
                                <tr>
                                    <th class="px-8 py-5">Posición</th>
                                    <th class="px-6 py-5">Equipo</th>
                                    <th class="px-6 py-5">Líder del Equipo</th>
                                    <th class="px-6 py-5 text-right">Puntuación</th>
                                    <th class="px-6 py-5 text-right">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#2c3240] text-sm text-gray-300">
                                @foreach($ranking as $index => $entry)
                                    <tr class="hover:bg-gradient-to-r hover:from-[#2c3240]/40 hover:to-transparent transition-all duration-300 group {{ (isset($registration) && $registration->id == $entry->id) ? 'bg-gradient-to-r from-[#10b981]/10 to-transparent border-l-4 border-[#10b981]' : '' }}">
                                        {{-- Posición --}}
                                        <td class="px-8 py-5">
                                            @if($index < 3)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-lg shadow-lg
                                                        @if($index == 0) bg-gradient-to-br from-yellow-500 to-yellow-600 text-white
                                                        @elseif($index == 1) bg-gradient-to-br from-gray-400 to-gray-500 text-white
                                                        @else bg-gradient-to-br from-orange-500 to-orange-600 text-white @endif">
                                                        {{ $index + 1 }}
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-500 font-bold text-lg px-3">#{{ $index + 1 }}</span>
                                            @endif
                                        </td>

                                        {{-- Equipo --}}
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-white group-hover:text-[#10b981] transition-colors text-base">
                                                    {{ $entry->team_name }}
                                                </span>
                                                @if(isset($registration) && $registration->id == $entry->id)
                                                    <span class="text-[10px] bg-gradient-to-r from-[#10b981] to-[#059669] text-white px-2 py-1 rounded-lg font-bold shadow-md">
                                                        <i class="fas fa-user-check mr-1"></i>TU EQUIPO
                                                    </span>
                                                @endif
                                            </div>
                                        </td>

                                        {{-- Líder --}}
                                        <td class="px-6 py-5 text-gray-400">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-user-circle text-[#10b981]"></i>
                                                {{ $entry->teamLeader->name ?? $entry->user_name ?? 'N/A' }}
                                            </div>
                                        </td>

                                        {{-- Puntos --}}
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-block bg-[#0f111a] px-4 py-2 rounded-lg border border-[#2c3240] shadow-md">
                                                <span class="text-[#10b981] font-mono font-bold text-lg">
                                                    {{ number_format($entry->score ?? $entry->points) }}
                                                </span>
                                                <span class="text-xs text-gray-500 ml-1">pts</span>
                                            </div>
                                        </td>

                                        {{-- Estado --}}
                                        <td class="px-6 py-5 text-right">
                                            @if(isset($entry->status))
                                                <span class="text-xs font-bold px-3 py-2 rounded-lg border shadow-md inline-block
                                                    @if($entry->status == 'qualified') 
                                                        bg-gradient-to-r from-[#10b981]/20 to-[#059669]/10 border-[#10b981] text-[#10b981]
                                                    @else 
                                                        bg-gray-700/20 border-gray-600 text-gray-400
                                                    @endif">
                                                    <i class="fas fa-{{ $entry->status == 'qualified' ? 'check-circle' : 'clock' }} mr-1"></i>
                                                    {{ $entry->status == 'qualified' ? 'CLASIFICADO' : 'REGISTRADO' }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>