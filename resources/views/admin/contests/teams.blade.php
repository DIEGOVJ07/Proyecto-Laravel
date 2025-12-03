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
                        Lista de Equipos
                    </h3>
                </div>

                <div class="divide-y divide-cb-border">
                    @forelse($contest->registrations as $registration)
                        <div class="p-6 hover:bg-cb-dark/50 transition">
                            <div class="flex items-start justify-between">
                                {{-- Información del equipo --}}
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <h4 class="text-xl font-bold text-white">{{ $registration->team_name }}</h4>
                                        @if($registration->status == 'qualified')
                                            <span class="px-3 py-1 bg-cb-green/20 text-cb-green border border-cb-green rounded-full text-xs font-semibold">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Clasificado
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500 rounded-full text-xs font-semibold">
                                                Registrado
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-user text-cb-green mr-2"></i>
                                                Líder: <span class="text-white font-medium">{{ $registration->user->name }}</span>
                                            </p>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-envelope text-cb-green mr-2"></i>
                                                Email: <span class="text-white">{{ $registration->user->email }}</span>
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-phone text-cb-green mr-2"></i>
                                                Teléfono: <span class="text-white">{{ $registration->leader_phone }}</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-users text-cb-green mr-2"></i>
                                                Integrantes: <span class="text-white font-medium">{{ $registration->team_size }}</span>
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-calendar text-cb-green mr-2"></i>
                                                Registrado: <span class="text-white">{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Integrantes --}}
                                    <div class="mt-4">
                                        <p class="text-gray-400 text-sm font-medium mb-3">
                                            <i class="fas fa-id-card text-cb-green mr-2"></i>
                                            Miembros del Equipo:
                                        </p>
                                        <div class="grid md:grid-cols-2 gap-3">
                                            @foreach($registration->team_members as $index => $member)
                                                <div class="flex items-center space-x-3 bg-cb-dark/50 p-3 rounded-lg">
                                                    <div class="w-8 h-8 bg-cb-green/10 rounded-full flex items-center justify-center">
                                                        <span class="text-cb-green font-bold text-sm">{{ $index + 1 }}</span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="text-white font-medium text-sm">{{ $member['name'] }}</p>
                                                        <p class="text-gray-400 text-xs">
                                                            Nac: {{ \Carbon\Carbon::parse($member['birthdate'])->format('d/m/Y') }}
                                                            ({{ \Carbon\Carbon::parse($member['birthdate'])->age }} años)
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Acciones --}}
                                <div class="ml-6 flex flex-col space-y-2">
                                    @if($registration->status == 'qualified')
                                        <form method="POST" action="{{ route('admin.contests.teams.disqualify', [$contest->id, $registration->id]) }}">
                                            @csrf
                                            <button type="submit" class="w-full px-4 py-2 bg-yellow-500/10 text-yellow-400 border border-yellow-500 rounded-lg hover:bg-yellow-500/20 transition text-sm font-medium" onclick="return confirm('¿Desclasificar este equipo?')">
                                                <i class="fas fa-times-circle mr-2"></i>
                                                Desclasificar
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.contests.teams.qualify', [$contest->id, $registration->id]) }}">
                                            @csrf
                                            <button type="submit" class="w-full px-4 py-2 bg-cb-green/10 text-cb-green border border-cb-green rounded-lg hover:bg-cb-green/20 transition text-sm font-medium" onclick="return confirm('¿Clasificar este equipo?')">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Clasificar
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.contests.teams.delete', [$contest->id, $registration->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-500/10 text-red-400 border border-red-500 rounded-lg hover:bg-red-500/20 transition text-sm font-medium" onclick="return confirm('¿Eliminar este equipo? Esta acción no se puede deshacer.')">
                                            <i class="fas fa-trash mr-2"></i>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
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