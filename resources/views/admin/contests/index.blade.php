<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-shield-alt text-yellow-400 mr-2"></i>
                Panel de Administración - Concursos
            </h2>
            <a href="{{ route('admin.contests.create') }}" class="px-4 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-plus mr-2"></i>
                Crear Concurso
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

            {{-- Tabla de concursos --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <table class="w-full">
                    <thead class="bg-cb-dark">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Concurso</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Dificultad</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Fecha</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Equipos</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Premio</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cb-border">
                        @forelse($contests as $contest)
                            <tr class="hover:bg-cb-dark/50 transition">
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">{{ $contest->name }}</div>
                                    <div class="text-gray-400 text-sm">{{ Str::limit($contest->description, 50) }}</div>
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
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($contest->difficulty == 'Difícil') bg-red-900/40 text-red-300
                                        @elseif($contest->difficulty == 'Medio') bg-yellow-900/40 text-yellow-300
                                        @else bg-green-900/40 text-green-300
                                        @endif
                                    ">
                                        {{ $contest->difficulty }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-sm">
                                    {{ $contest->start_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.contests.teams', $contest->id) }}" class="text-cb-green hover:text-green-400 font-medium">
                                        {{ $contest->registrations_count }} equipos
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-white font-medium">
                                    ${{ number_format($contest->prize) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.contests.teams', $contest->id) }}" class="p-2 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500/20 transition" title="Ver equipos">
                                            <i class="fas fa-users"></i>
                                        </a>

                                        @if($contest->status != 'Finalizado')
                                            <form method="POST" action="{{ route('admin.contests.close', $contest->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="p-2 bg-yellow-500/10 text-yellow-400 rounded hover:bg-yellow-500/20 transition" title="Cerrar concurso" onclick="return confirm('¿Cerrar este concurso?')">
                                                    <i class="fas fa-lock"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('admin.contests.destroy', $contest->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-500/10 text-red-400 rounded hover:bg-red-500/20 transition" title="Eliminar" onclick="return confirm('¿Eliminar este concurso? Esta acción no se puede deshacer.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    <i class="fas fa-inbox text-4xl mb-4"></i>
                                    <p>No hay concursos registrados</p>
                                    <a href="{{ route('admin.contests.create') }}" class="mt-4 inline-block px-6 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                                        <i class="fas fa-plus mr-2"></i>
                                        Crear Primer Concurso
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-6">
                {{ $contests->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
