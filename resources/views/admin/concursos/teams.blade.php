<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-white leading-tight">
                    <i class="fas fa-users text-cb-green mr-2"></i>
                    Equipos Participantes
                </h2>
                <p class="text-gray-400 text-sm mt-1">{{ $contest->name }}</p>
            </div>
            <a href="{{ route('admin.contests.index') }}" class="px-4 py-2 bg-cb-border text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Información del concurso --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6 mb-6">
                <div class="grid md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Estado</p>
                        <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full
                            @if($contest->status == 'Activo') bg-cb-green/20 text-cb-green border border-cb-green
                            @elseif($contest->status == 'Próximamente') bg-blue-900/40 text-blue-300 border border-blue-600
                            @else bg-gray-600/40 text-gray-300 border border-gray-500
                            @endif
                        ">
                            {{ $contest->status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Equipos Registrados</p>
                        <p class="text-white font-bold text-2xl mt-1">{{ $contest->registrations->count() }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Equipos Clasificados</p>
                        <p class="text-cb-green font-bold text-2xl mt-1">{{ $contest->registrations->where('status', 'qualified')->count() }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Fecha del Concurso</p>
                        <p class="text-white font-bold mt-1">{{ $contest->start_date->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Lista de equipos --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="p-6 border-b border-cb-border">
                    <h3 class="text-xl font-bold text-white">
                        <i class="fas fa-list mr-2 text-cb-green"></i>
                        Lista de Equipos y Calificaciones
                    </h3>
                </div>

                <div class="divide-y divide-cb-border">
                    @forelse($contest->registrations as $registration)
                        {{-- Usamos x-data aquí para controlar el modal de cada fila independientemente --}}
                        <div x-data="{ showGradeModal: false }" class="p-6 hover:bg-cb-dark/50 transition">
                            <div class="flex items-start justify-between">
                                
                                {{-- Información del equipo --}}
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <h4 class="text-xl font-bold text-white">{{ $registration->team_name }}</h4>
                                        <span class="px-2 py-1 bg-purple-500/20 text-purple-400 border border-purple-500 rounded text-xs font-semibold">
                                            {{ $registration->team_code }}
                                        </span>
                                        
                                        {{-- Badge de Estado y Puntaje --}}
                                        @if($registration->score > 0)
                                            <span class="px-3 py-1 font-bold text-sm rounded-full border flex items-center
                                                {{ $registration->status == 'qualified' ? 'bg-green-500/20 text-green-400 border-green-500' : 'bg-red-500/20 text-red-400 border-red-500' }}">
                                                @if($registration->status == 'qualified')
                                                    <i class="fas fa-check-circle mr-2"></i>
                                                @else
                                                    <i class="fas fa-times-circle mr-2"></i>
                                                @endif
                                                {{ $registration->score }} pts - {{ $registration->status == 'qualified' ? 'Clasificado' : 'No Clasificado' }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-600/30 text-gray-400 border border-gray-600 rounded-full text-xs font-semibold">
                                                <i class="fas fa-hourglass-start mr-1"></i> Pendiente de Calificar
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                                        {{-- Info Líder --}}
                                        <div>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-crown text-yellow-500 mr-2"></i>
                                                Líder: <span class="text-white font-medium">{{ $registration->teamLeader->name ?? $registration->user->name }}</span>
                                            </p>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-envelope text-cb-green mr-2"></i>
                                                Email: <span class="text-white">{{ $registration->teamLeader->email ?? $registration->user->email }}</span>
                                            </p>
                                        </div>
                                        {{-- Info Miembros --}}
                                        <div>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-users text-cb-green mr-2"></i>
                                                Miembros: <span class="text-white font-medium">{{ $registration->current_members }}/{{ $registration->max_members }}</span>
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-calendar text-cb-green mr-2"></i>
                                                Registrado: <span class="text-white">{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Desglose de Miembros (Expandible o visible) --}}
                                    <div class="mt-4 p-3 bg-cb-dark/30 rounded-lg border border-cb-border">
                                        <p class="text-gray-400 text-xs font-bold uppercase mb-2">Integrantes</p>
                                        <div class="flex flex-wrap gap-2">
                                            {{-- Líder --}}
                                            <div class="flex items-center space-x-2 bg-cb-dark px-2 py-1 rounded border border-yellow-500/30">
                                                <i class="fas fa-crown text-yellow-500 text-xs"></i>
                                                <span class="text-white text-sm">{{ $registration->teamLeader->name ?? $registration->user->name }}</span>
                                            </div>
                                            {{-- Miembros --}}
                                            @foreach($registration->members as $teamMember)
                                                <div class="flex items-center space-x-2 bg-cb-dark px-2 py-1 rounded border border-cb-border">
                                                    <span class="text-gray-300 text-sm">{{ $teamMember->user->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- ACCIONES (Botones) --}}
                                <div class="ml-6 flex flex-col space-y-3 min-w-[160px]">
                                    
                                    {{-- Botón CALIFICAR (Abre Modal) --}}
                                    <button @click="showGradeModal = true" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg transition shadow-lg shadow-blue-900/50 flex items-center justify-center">
                                        <i class="fas fa-star mr-2"></i>
                                        Calificar
                                    </button>

                                    {{-- Botón ELIMINAR --}}
                                    <form method="POST" action="{{ route('admin.contests.teams.delete', [$contest->id, $registration->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-500/10 text-red-400 border border-red-500 rounded-lg hover:bg-red-500/20 transition text-sm font-medium flex items-center justify-center" onclick="return confirm('¿Eliminar este equipo? Esta acción no se puede deshacer.')">
                                            <i class="fas fa-trash mr-2"></i>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- ========================================== --}}
                            {{-- MODAL DE CALIFICACIÓN (Alpine.js)          --}}
                            {{-- ========================================== --}}
                            <div x-show="showGradeModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    
                                    {{-- Fondo oscuro transparente --}}
                                    <div x-show="showGradeModal" 
                                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                         @click="showGradeModal = false" class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                    {{-- Panel del Modal --}}
                                    <div x-show="showGradeModal" 
                                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         class="inline-block align-bottom bg-cb-card border border-cb-border rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                        
                                        <form method="POST" action="{{ route('admin.contests.teams.grade', [$contest->id, $registration->id]) }}">
                                            @csrf
                                            <div class="bg-cb-dark px-4 py-5 sm:p-6">
                                                <h3 class="text-xl leading-6 font-bold text-white mb-1" id="modal-title">
                                                    Evaluación de Equipo
                                                </h3>
                                                <p class="text-sm text-gray-400 mb-6">Equipo: <span class="text-cb-green font-bold">{{ $registration->team_name }}</span></p>
                                                
                                                <div class="space-y-5">
                                                    {{-- Criterio 1: Funcionalidad --}}
                                                    <div>
                                                        <label class="flex justify-between text-sm font-medium text-gray-300 mb-1">
                                                            <span>Funcionalidad y Completitud</span>
                                                            <span class="text-gray-500">Máx 40 pts</span>
                                                        </label>
                                                        <input type="number" name="criteria_functionality" min="0" max="40" required 
                                                            value="{{ data_get($registration->score_details, 'functionality', 0) }}"
                                                            class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:ring-2 focus:ring-cb-green focus:border-transparent outline-none">
                                                    </div>

                                                    {{-- Criterio 2: Código --}}
                                                    <div>
                                                        <label class="flex justify-between text-sm font-medium text-gray-300 mb-1">
                                                            <span>Calidad de Código y Estructura</span>
                                                            <span class="text-gray-500">Máx 30 pts</span>
                                                        </label>
                                                        <input type="number" name="criteria_code" min="0" max="30" required 
                                                            value="{{ data_get($registration->score_details, 'code', 0) }}"
                                                            class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:ring-2 focus:ring-cb-green focus:border-transparent outline-none">
                                                    </div>

                                                    {{-- Criterio 3: Diseño --}}
                                                    <div>
                                                        <label class="flex justify-between text-sm font-medium text-gray-300 mb-1">
                                                            <span>Diseño UI/UX e Innovación</span>
                                                            <span class="text-gray-500">Máx 30 pts</span>
                                                        </label>
                                                        <input type="number" name="criteria_design" min="0" max="30" required 
                                                            value="{{ data_get($registration->score_details, 'design', 0) }}"
                                                            class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:ring-2 focus:ring-cb-green focus:border-transparent outline-none">
                                                    </div>

                                                    {{-- Feedback --}}
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-300 mb-1">Feedback / Comentarios</label>
                                                        <textarea name="feedback" rows="3" class="w-full bg-gray-800 border border-gray-600 rounded-lg text-white px-3 py-2 focus:ring-2 focus:ring-cb-green focus:border-transparent outline-none" placeholder="Opcional: Razones de la calificación...">{{ $registration->feedback }}</textarea>
                                                    </div>

                                                    {{-- Regla de Negocio (Información) --}}
                                                    <div class="bg-blue-500/10 border border-blue-500/30 p-3 rounded-lg flex items-start gap-3">
                                                        <i class="fas fa-info-circle text-blue-400 mt-0.5"></i>
                                                        <div class="text-xs text-blue-200">
                                                            <p class="font-bold mb-1">Regla de Clasificación:</p>
                                                            <ul class="list-disc list-inside">
                                                                <li>Menos de <strong>50 puntos</strong>: No Clasifica.</li>
                                                                <li><strong>50 puntos</strong> o más: Clasifica Automáticamente.</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-cb-border">
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cb-green text-base font-bold text-cb-dark hover:bg-green-500 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition">
                                                    Guardar Calificación
                                                </button>
                                                <button type="button" @click="showGradeModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-600 shadow-sm px-4 py-2 bg-transparent text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- FIN MODAL --}}

                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <i class="fas fa-users-slash text-4xl text-gray-600 mb-4"></i>
                            <p class="text-gray-400">No hay equipos registrados en este concurso</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>