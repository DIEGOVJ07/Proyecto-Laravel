<x-app-layout>
    <div class="bg-gradient-to-b from-[#0f111a] via-[#0f111a] to-[#0a0c14] min-h-screen py-12 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Encabezado --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#10b981]/10 via-transparent to-purple-500/10 blur-3xl"></div>
                <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-8 shadow-2xl">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center shadow-lg shadow-[#10b981]/30">
                                    <i class="fas fa-trophy text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl md:text-4xl font-bold text-white">
                                        Concursos Disponibles
                                    </h2>
                                    <p class="text-gray-400 text-sm mt-1">Participa en competencias y demuestra tu talento</p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Filtros rápidos --}}
                        <div class="flex gap-3 flex-wrap">
                            <button onclick="filterContests('all', this)" 
                                    class="filter-btn px-5 py-3 bg-gradient-to-r from-[#10b981] to-[#059669] border-2 border-[#10b981] rounded-xl text-white text-sm font-bold shadow-lg shadow-[#10b981]/40 transition-all duration-300 hover:scale-105">
                                <i class="fas fa-globe mr-2"></i> Todos
                            </button>
                            <button onclick="filterContests('activo', this)" 
                                    class="filter-btn px-5 py-3 bg-[#151a25] border-2 border-[#2c3240] rounded-xl text-gray-400 text-sm font-bold transition-all duration-300 hover:border-blue-500 hover:text-blue-400 hover:bg-blue-500/10">
                                <i class="fas fa-fire mr-2"></i> Activos
                            </button>
                            <button onclick="filterContests('upcoming', this)" 
                                    class="filter-btn px-5 py-3 bg-[#151a25] border-2 border-[#2c3240] rounded-xl text-gray-400 text-sm font-bold transition-all duration-300 hover:border-yellow-500 hover:text-yellow-400 hover:bg-yellow-500/10">
                                <i class="fas fa-clock mr-2"></i> Próximos
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grid de Concursos --}}
            <div id="contests-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($contests as $contest)
                    <div class="contest-card relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-6 hover:border-[#10b981]/50 transition-all duration-500 group flex flex-col h-full shadow-xl hover:shadow-2xl hover:shadow-[#10b981]/10 hover:-translate-y-1" 
                         data-status="{{ strtolower($contest->status) }}">
                        
                        {{-- Efecto de brillo --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-[#10b981]/0 via-[#10b981]/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        {{-- Header --}}
                        <div class="relative flex justify-between items-start mb-5">
                            <span class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider flex items-center gap-2 shadow-md
                                @if ($contest->status == 'Activo') 
                                    bg-gradient-to-r from-blue-500/40 to-blue-600/40 border border-blue-500/50 text-blue-300 animate-pulse
                                @elseif ($contest->status == 'Próximo' || $contest->status == 'Próximamente') 
                                    bg-gradient-to-r from-yellow-500/40 to-orange-500/40 border border-yellow-500/50 text-yellow-300
                                @else 
                                    bg-gradient-to-r from-gray-600/40 to-gray-700/40 border border-gray-600/50 text-gray-400
                                @endif">
                                <i class="fas fa-circle text-xs"></i>
                                {{ $contest->status }}
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
                        <p class="relative text-gray-400 text-sm mb-6 line-clamp-3 flex-grow leading-relaxed">
                            {{ $contest->description }}
                        </p>

                        {{-- Información --}}
                        <div class="relative border-t border-[#2c3240] pt-5 mt-auto space-y-4">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 text-sm bg-[#0f111a] px-3 py-2 rounded-lg border border-[#2c3240]">
                                    <i class="far fa-calendar text-[#10b981] text-base"></i>
                                    <span class="text-gray-300 text-xs font-medium">{{ \Carbon\Carbon::parse($contest->start_date)->format('d M') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm bg-[#0f111a] px-3 py-2 rounded-lg border border-[#2c3240]">
                                    <i class="fas fa-users text-[#10b981] text-base"></i>
                                    <span class="text-gray-300 text-xs font-medium">{{ $contest->registrations_count ?? 0 }} equipos</span>
                                </div>
                            </div>

                            {{-- Botón de acción --}}
                            <a href="{{ route('concursos.show', $contest->id) }}" class="block w-full py-3 bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white text-center rounded-xl text-sm font-bold transition-all duration-300 shadow-lg shadow-[#10b981]/20 hover:shadow-[#10b981]/40 group/btn">
                                <span class="flex items-center justify-center gap-2">
                                    Ver Detalles
                                    <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="relative bg-gradient-to-br from-[#151a25] to-[#0f111a] border border-[#2c3240] rounded-2xl p-16 text-center shadow-xl overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-[#10b981]/5 via-transparent to-purple-500/5"></div>
                            <div class="relative">
                                <div class="w-20 h-20 bg-gradient-to-br from-[#2c3240] to-[#1a1f2e] rounded-2xl flex items-center justify-center mx-auto mb-6 text-gray-500 shadow-xl">
                                    <i class="fas fa-trophy text-4xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-3">No hay concursos disponibles</h3>
                                <p class="text-gray-400 text-base">Próximamente habrá nuevos concursos disponibles.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function filterContests(status, button) {
            const cards = document.querySelectorAll('.contest-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Restablecer todos los botones al estado inactivo
            buttons.forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-[#10b981]', 'to-[#059669]', 'border-[#10b981]', 'text-white', 'shadow-lg', 'shadow-[#10b981]/40', 'scale-105');
                btn.classList.remove('from-blue-500', 'to-blue-600', 'border-blue-500', 'shadow-blue-500/40');
                btn.classList.remove('from-yellow-500', 'to-orange-500', 'border-yellow-500', 'shadow-yellow-500/40');
                btn.classList.add('bg-[#151a25]', 'border-[#2c3240]', 'text-gray-400');
            });
            
            // Activar el botón seleccionado según el filtro
            if (status === 'all') {
                button.classList.remove('bg-[#151a25]', 'border-[#2c3240]', 'text-gray-400');
                button.classList.add('bg-gradient-to-r', 'from-[#10b981]', 'to-[#059669]', 'border-[#10b981]', 'text-white', 'shadow-lg', 'shadow-[#10b981]/40');
            } else if (status === 'activo') {
                button.classList.remove('bg-[#151a25]', 'border-[#2c3240]', 'text-gray-400');
                button.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-blue-600', 'border-blue-500', 'text-white', 'shadow-lg', 'shadow-blue-500/40');
            } else if (status === 'upcoming') {
                button.classList.remove('bg-[#151a25]', 'border-[#2c3240]', 'text-gray-400');
                button.classList.add('bg-gradient-to-r', 'from-yellow-500', 'to-orange-500', 'border-yellow-500', 'text-white', 'shadow-lg', 'shadow-yellow-500/40');
            }
            
            // Filtrar tarjetas
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status || 
                    (status === 'upcoming' && (cardStatus === 'próximo' || cardStatus === 'próximamente'))) {
                    card.style.display = 'flex';
                    setTimeout(() => card.style.opacity = '1', 10);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => card.style.display = 'none', 300);
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
