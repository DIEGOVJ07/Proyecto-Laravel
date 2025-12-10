<x-app-layout>
    {{-- FONDO OSCURO PRINCIPAL --}}
    <div class="bg-[#0f111a] min-h-screen py-10 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. ENCABEZADO --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-[#2c3240] pb-6">
                <div>
                    <h2 class="font-bold text-3xl text-white leading-tight flex items-center gap-3">
                        <i class="fas fa-shield-alt text-[#f59e0b]"></i>
                        Panel de Concursos
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Gestiona y supervisa los torneos de la plataforma.</p>
                </div>
                
                {{-- BOTÓN CREAR (SOLO ADMIN) --}}
                @role('admin')
                <a href="{{ route('admin.concursos.create') }}" class="px-5 py-2.5 bg-[#10b981] hover:bg-[#059669] text-white font-bold rounded-lg transition shadow-lg shadow-[#10b981]/20 flex items-center gap-2 text-sm uppercase tracking-wide">
                    <i class="fas fa-plus"></i> Crear Concurso
                </a>
                @endrole
            </div>

            {{-- MENSAJES --}}
            @if(session('success'))
                <div class="bg-[#10b981]/10 border border-[#10b981]/50 text-[#10b981] px-4 py-3 rounded-lg flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            {{-- 2. TABLA DE CONCURSOS --}}
            <div class="bg-[#151a25] border border-[#2c3240] rounded-xl overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#0f111a] text-gray-500 text-[10px] uppercase font-bold tracking-wider border-b border-[#2c3240]">
                            <tr>
                                <th class="px-6 py-4">Concurso</th>
                                <th class="px-6 py-4">Estado</th>
                                <th class="px-6 py-4">Dificultad</th>
                                <th class="px-6 py-4">Fecha</th>
                                <th class="px-6 py-4 text-center">Equipos</th>
                                <th class="px-6 py-4">Premio</th>
                                <th class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#2c3240] text-sm text-gray-300">
                            @forelse($contests as $contest)
                                <tr class="hover:bg-[#2c3240]/30 transition duration-150">
                                    
                                    {{-- Nombre --}}
                                    <td class="px-6 py-4">
                                        <div class="text-white font-bold text-base mb-1">{{ $contest->name }}</div>
                                        <div class="text-gray-500 text-xs truncate max-w-xs">{{ Str::limit($contest->description, 50) }}</div>
                                    </td>

                                    {{-- Estado --}}
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide border
                                            @if($contest->status == 'Activo') bg-[#10b981]/10 text-[#10b981] border-[#10b981]/30
                                            @elseif($contest->status == 'Próximamente') bg-blue-500/10 text-blue-400 border-blue-500/30
                                            @else bg-gray-600/10 text-gray-400 border-gray-600/30
                                            @endif">
                                            {{ $contest->status }}
                                        </span>
                                    </td>

                                    {{-- Dificultad --}}
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide border
                                            @if($contest->difficulty == 'Difícil') bg-red-500/10 text-red-400 border-red-500/30
                                            @elseif($contest->difficulty == 'Medio') bg-[#f59e0b]/10 text-[#f59e0b] border-[#f59e0b]/30
                                            @else bg-[#10b981]/10 text-[#10b981] border-[#10b981]/30
                                            @endif">
                                            {{ $contest->difficulty }}
                                        </span>
                                    </td>

                                    {{-- Fecha --}}
                                    <td class="px-6 py-4 text-gray-400 text-xs font-mono">
                                        {{ $contest->start_date->format('d/m/Y') }}
                                    </td>

                                    {{-- Equipos --}}
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.concursos.teams', $contest->id) }}" class="inline-flex items-center gap-2 px-3 py-1 bg-[#0f111a] rounded-lg border border-[#2c3240] hover:border-[#10b981] hover:text-white transition group text-xs">
                                            <i class="fas fa-users text-[#10b981] group-hover:text-white"></i>
                                            <span class="font-bold text-white">{{ $contest->registrations_count }}</span>
                                        </a>
                                    </td>

                                    {{-- Premio --}}
                                    <td class="px-6 py-4 text-[#10b981] font-mono font-bold">
                                        ${{ number_format($contest->prize) }}
                                    </td>

                                    {{-- ACCIONES --}}
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            
                                            {{-- ================================================== --}}
                                            {{-- BOTÓN DE CALIFICAR (VISIBLE PARA ADMIN Y JUEZ)     --}}
                                            {{-- ================================================== --}}
                                            @hasanyrole('admin|juez')
                                                <a href="{{ route('admin.concursos.teams', $contest->id) }}" 
                                                   class="p-2 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/30 hover:bg-blue-500 hover:text-white transition" 
                                                   title="Ver y Calificar Equipos">
                                                    <i class="fas fa-gavel"></i>
                                                </a>
                                            @endhasanyrole

                                            {{-- ================================================== --}}
                                            {{-- BOTONES EXCLUSIVOS DE ADMIN (Cerrar / Eliminar)    --}}
                                            {{-- ================================================== --}}
                                            @role('admin')
                                                @if($contest->status != 'Finalizado')
                                                    <form method="POST" action="{{ route('admin.concursos.close', $contest->id) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="p-2 rounded-lg bg-[#f59e0b]/10 text-[#f59e0b] border border-[#f59e0b]/30 hover:bg-[#f59e0b] hover:text-black transition" title="Cerrar concurso" onclick="return confirm('¿Cerrar este concurso?')">
                                                            <i class="fas fa-lock"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form method="POST" action="{{ route('admin.concursos.destroy', $contest->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 rounded-lg bg-red-500/10 text-red-400 border border-red-500/30 hover:bg-red-500 hover:text-white transition" title="Eliminar" onclick="return confirm('¿Eliminar este concurso?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endrole

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-inbox text-4xl mb-3 text-[#2c3240]"></i>
                                            <p class="text-sm">No hay concursos registrados.</p>
                                            @role('admin')
                                                <a href="{{ route('admin.concursos.create') }}" class="mt-4 px-4 py-2 bg-[#10b981] text-white text-xs font-bold rounded hover:bg-[#059669] transition">
                                                    Crear Primer Concurso
                                                </a>
                                            @endrole
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Paginación --}}
            <div class="mt-6">
                {{ $contests->links() }}
            </div>

        </div>
    </div>
</x-app-layout>