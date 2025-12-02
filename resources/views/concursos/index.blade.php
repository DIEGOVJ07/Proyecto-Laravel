<x-app-web>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Título -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2 tracking-tight">Todos los Concursos</h1>
            <p class="text-lg text-gray-400">Encuentra el desafío perfecto para ti</p>
        </div>

        <!-- FORMULARIO DE FILTROS -->
        <form method="GET" action="{{ route('dashboard') }}" id="filterForm"
            class="flex flex-col lg:flex-row gap-4 mb-10">

            <!-- Input de Búsqueda -->
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full bg-slate-800 border border-slate-600 text-white text-sm rounded-xl focus:ring-cyan-500 focus:border-cyan-500 block pl-12 p-3.5 placeholder-gray-400 shadow-sm transition-all"
                    placeholder="Buscar por nombre o descripción..." id="searchInput" autocomplete="off">
            </div>

            <!-- Grupo de Filtros -->
            <div class="flex items-center space-x-3 shrink-0">
                <div class="flex items-center text-gray-400 mr-2">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span class="text-sm font-medium">Filtros:</span>
                </div>

                <!-- Filtro Estado -->
                <select name="status" onchange="document.getElementById('filterForm').submit()"
                    class="bg-slate-800 border border-slate-600 text-white text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 p-2.5 pr-10 min-w-[140px] cursor-pointer hover:border-cyan-500/50 transition">
                    <option value="Todos">Todos los Estados</option>
                    <option value="Activo" {{ request('status') == 'Activo' ? 'selected' : '' }}>Activos</option>
                    <option value="Próximamente" {{ request('status') == 'Próximamente' ? 'selected' : '' }}>Próximos
                    </option>
                    <option value="Finalizado" {{ request('status') == 'Finalizado' ? 'selected' : '' }}>Finalizados
                    </option>
                </select>

                <!-- Filtro Dificultad -->
                <select name="difficulty" onchange="document.getElementById('filterForm').submit()"
                    class="bg-slate-800 border border-slate-600 text-white text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 p-2.5 pr-10 min-w-[140px] cursor-pointer hover:border-cyan-500/50 transition">
                    <option value="Todos">Cualquier Nivel</option>
                    <option value="Fácil" {{ request('difficulty') == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                    <option value="Medio" {{ request('difficulty') == 'Medio' ? 'selected' : '' }}>Medio</option>
                    <option value="Difícil" {{ request('difficulty') == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                </select>
            </div>
        </form>

        <!-- Grid de Tarjetas -->
        @if ($contests->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in-up">
                @foreach ($contests as $contest)
                    <x-contest-card :contest="$contest" />
                @endforeach
            </div>
        @else
            <!-- Mensaje de No Encontrado -->
            <div
                class="flex flex-col items-center justify-center text-center py-24 px-4 bg-cb-card/50 rounded-2xl border border-dashed border-gray-800">
                <div class="bg-cb-dark p-4 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No se encontraron concursos</h3>
                <p class="text-gray-400 max-w-sm">
                    No hay resultados para "<span class="text-cb-green font-medium">{{ request('search') }}</span>" con
                    los filtros seleccionados. Intenta buscar otra cosa.
                </p>
                <a href="{{ route('dashboard') }}"
                    class="mt-6 px-6 py-2 bg-cb-card hover:bg-cb-border text-white text-sm font-medium rounded-lg transition border border-gray-700">
                    Limpiar filtros
                </a>
            </div>
        @endif
    </div>

    <!-- Script para Búsqueda Automática (Debounce) -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const filterForm = document.getElementById('filterForm');
        let timeout = null;

        // Escuchar cuando el usuario escribe
        searchInput.addEventListener('input', function() {
            // Limpiar el temporizador anterior si sigue escribiendo
            clearTimeout(timeout);

            // Esperar 500ms después de que deje de escribir para enviar el formulario
            timeout = setTimeout(function() {
                filterForm.submit();
            }, 600); // 600ms de retraso para que no recargue en cada letra
        });

        // Poner el foco al final del input después de recargar (Mejora de UX)
        document.addEventListener('DOMContentLoaded', function() {
            const val = searchInput.value;
            searchInput.focus();
            searchInput.setSelectionRange(val.length, val.length);
        });
    </script>
</x-app-web>
