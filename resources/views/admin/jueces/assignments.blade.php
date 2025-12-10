<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-white leading-tight">
                    <i class="fas fa-clipboard-list text-cb-green mr-2"></i>
                    Asignaciones: {{ $judge->name }}
                </h2>
                <p class="text-gray-400 text-sm mt-1">{!! $judge->getCertificationBadge() !!} • {{ $judge->specialty }}</p>
            </div>
            <a href="{{ route('admin.jueces.index') }}" class="px-4 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Información del Juez --}}
            <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl p-6">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        {{ $judge->getInitials() }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $judge->name }}</h3>
                        <div class="flex items-center space-x-4 text-sm text-gray-400">
                            <span><i class="fas fa-envelope mr-1"></i> {{ $judge->email }}</span>
                            @if($judge->phone)
                                <span><i class="fas fa-phone mr-1"></i> {{ $judge->phone }}</span>
                            @endif
                            <span><i class="fas fa-building mr-1"></i> {{ $judge->institution ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cb-green">{{ $judge->contests->count() }}</div>
                        <div class="text-gray-400 text-sm">Asignaciones</div>
                    </div>
                </div>
            </div>

            {{-- Asignar a nuevo concurso --}}
            @if($availableContests->count() > 0)
                <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                    <h3 class="text-xl font-bold text-white mb-4">
                        <i class="fas fa-plus-circle text-cb-green mr-2"></i>
                        Asignar a Nuevo Concurso
                    </h3>

                    <form method="POST" action="{{ route('admin.jueces.assign', $judge) }}" class="grid md:grid-cols-3 gap-4">
                        @csrf
                        
                        <div>
                            <label class="block text-gray-300 font-medium mb-2">Seleccionar Concurso</label>
                            <select name="contest_id" required
                                class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                <option value="">Seleccionar...</option>
                                @foreach($availableContests as $contest)
                                    <option value="{{ $contest->id }}">{{ $contest->name }} ({{ $contest->start_date->format('d/m/Y') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-300 font-medium mb-2">Rol en el Concurso</label>
                            <select name="role" required
                                class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                <option value="">Seleccionar...</option>
                                <option value="Evaluador Principal">Evaluador Principal</option>
                                <option value="Evaluador Secundario">Evaluador Secundario</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Asistente">Asistente</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i>
                                Asignar
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            {{-- Concursos asignados --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="p-6 border-b border-cb-border">
                    <h3 class="text-xl font-bold text-white">
                        <i class="fas fa-trophy text-cb-green mr-2"></i>
                        Concursos Asignados
                    </h3>
                </div>

                @if($judge->contests->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-cb-dark">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Concurso</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Equipos</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-cb-border">
                                @foreach($judge->contests as $contest)
                                    <tr class="hover:bg-cb-dark/50 transition">
                                        <td class="px-6 py-4">
                                            <div class="text-white font-medium">{{ $contest->name }}</div>
                                            <div class="text-gray-400 text-sm">{{ Str::limit($contest->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-purple-500/20 text-purple-400 border border-purple-500 rounded-full text-xs font-semibold">
                                                {{ $contest->pivot->role }}
                                            </span>
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
                                        <td class="px-6 py-4 text-gray-400 text-sm">
                                            {{ $contest->start_date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-white">
                                            {{ $contest->registrations_count ?? 0 }} equipos
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.concursos.teams', $contest->id) }}" class="p-2 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500/20 transition" title="Ver concurso">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.jueces.remove-contest', [$judge, $contest]) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-red-500/10 text-red-400 rounded hover:bg-red-500/20 transition" title="Remover asignación" onclick="return confirm('¿Remover al juez de este concurso?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-12 text-center text-gray-400">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>Este juez no tiene asignaciones aún</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>