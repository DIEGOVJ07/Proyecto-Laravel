<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-white leading-tight flex items-center">
                    <i class="fas fa-crown text-yellow-400 mr-2"></i>
                    Panel de Administrador
                </h2>
                <p class="text-gray-400 text-sm mt-1">Vista completa del sistema</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.concursos.create') }}" class="px-4 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                    <i class="fas fa-plus mr-2"></i>
                    Crear Concurso
                </a>
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-cog mr-2"></i>
                    Configuración
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Información del Admin --}}
            <div class="bg-gradient-to-r from-yellow-900/20 to-cb-card border border-yellow-500/30 rounded-xl shadow-xl p-6">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-3xl font-bold text-cb-dark shadow-lg">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-white mb-1 flex items-center">
                            {{ $user->name }}
                            <span class="ml-3 px-3 py-1 bg-yellow-500/20 text-yellow-400 border border-yellow-500 rounded-full text-xs font-semibold">
                                ADMINISTRADOR
                            </span>
                        </h2>
                        <p class="text-gray-400">
                            <i class="fas fa-envelope mr-2 text-yellow-400"></i>
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Estadísticas del Sistema --}}
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-cb-green/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trophy text-cb-green text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-up text-green-400 text-sm"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1">{{ $contests->count() }}</h3>
                    <p class="text-gray-400 text-sm">Total Concursos</p>
                </div>

                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-400 text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-up text-green-400 text-sm"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1">{{ $contests->sum('registrations_count') }}</h3>
                    <p class="text-gray-400 text-sm">Equipos Registrados</p>
                </div>

                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-fire text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1">{{ $contests->where('status', 'Activo')->count() }}</h3>
                    <p class="text-gray-400 text-sm">Concursos Activos</p>
                </div>

                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-purple-400 text-xl"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-1">{{ $contests->where('status', 'Próximamente')->count() }}</h3>
                    <p class="text-gray-400 text-sm">Próximos</p>
                </div>
            </div>

            {{-- Accesos Rápidos --}}
            <div class="grid md:grid-cols-4 gap-6">
                <a href="{{ route('admin.concursos.index') }}" class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-cb-green/10 rounded-lg flex items-center justify-center group-hover:bg-cb-green/20 transition">
                            <i class="fas fa-list text-cb-green text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg">Gestionar Concursos</h4>
                            <p class="text-gray-400 text-sm">Ver, editar y eliminar</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.concursos.create') }}" class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border hover:border-blue-500/50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center group-hover:bg-blue-500/20 transition">
                            <i class="fas fa-plus-circle text-blue-400 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg">Crear Concurso</h4>
                            <p class="text-gray-400 text-sm">Nuevo evento</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.jueces.index') }}" class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border hover:border-yellow-500/50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-yellow-500/10 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/20 transition">
                            <i class="fas fa-gavel text-yellow-400 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg">Gestionar Jueces</h4>
                            <p class="text-gray-400 text-sm">Administrar evaluadores</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('clasificacion.index') }}" class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border hover:border-purple-500/50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-purple-500/10 rounded-lg flex items-center justify-center group-hover:bg-purple-500/20 transition">
                            <i class="fas fa-chart-line text-purple-400 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg">Clasificación</h4>
                            <p class="text-gray-400 text-sm">Ver rankings</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Concursos Recientes --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="p-6 border-b border-cb-border flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-trophy text-cb-green mr-3"></i>
                        Concursos del Sistema
                    </h3>
                    <a href="{{ route('admin.concursos.index') }}" class="text-cb-green hover:text-green-400 text-sm font-medium">
                        Ver todos →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-cb-dark">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Concurso</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Equipos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Fecha</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cb-border">
                            @forelse($contests->take(5) as $contest)
                                <tr class="hover:bg-cb-dark/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="text-white font-medium">{{ $contest->name }}</div>
                                        <div class="text-gray-400 text-sm">{{ Str::limit($contest->description, 40) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                                            @if($contest->status == 'Activo') bg-cb-green/20 text-cb-green border border-cb-green
                                            @elseif($contest->status == 'Próximamente') bg-blue-900/40 text-blue-300 border border-blue-600
                                            @else bg-gray-600/40 text-gray-300 border border-gray-500
                                            @endif
                                        ">
                                            {{ $contest->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-white font-medium">{{ $contest->registrations_count }}</span>
                                        <span class="text-gray-400 text-sm">equipos</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 text-sm">
                                        {{ $contest->start_date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.concursos.teams', $contest->id) }}" class="p-2 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500/20 transition" title="Ver equipos">
                                                <i class="fas fa-users"></i>
                                            </a>
                                            <a href="{{ route('admin.concursos.index') }}" class="p-2 bg-cb-green/10 text-cb-green rounded hover:bg-cb-green/20 transition" title="Gestionar">
                                                <i class="fas fa-cog"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        No hay concursos creados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Inscripciones Recientes --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-user-plus text-cb-green mr-3"></i>
                    Inscripciones Recientes
                </h3>

                @if($recentRegistrations->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentRegistrations as $registration)
                            <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-cb-green/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-cb-green"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $registration->user->name }}</p>
                                        <p class="text-gray-400 text-sm">
                                            Equipo: {{ $registration->team_name }} → {{ $registration->contest->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($registration->status == 'qualified')
                                        <span class="px-3 py-1 bg-cb-green/20 text-cb-green border border-cb-green rounded-full text-xs font-semibold">
                                            Clasificado
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500 rounded-full text-xs font-semibold">
                                            Registrado
                                        </span>
                                    @endif
                                    <p class="text-gray-400 text-xs mt-1">{{ $registration->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-4xl text-gray-600 mb-4"></i>
                        <p class="text-gray-400">No hay inscripciones recientes</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>     