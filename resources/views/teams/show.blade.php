<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-users text-cb-green mr-2"></i>
            {{ $team->team_name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

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

            {{-- Información del Equipo --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="bg-gradient-to-r from-cb-green/20 to-cb-card p-8 border-b border-cb-border">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-2">{{ $team->team_name }}</h3>
                            <p class="text-gray-400">{{ $team->contest->name }}</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-cb-green">{{ $team->team_code }}</div>
                            <p class="text-gray-400 text-sm">Código</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6 text-sm">
                        <span class="px-3 py-1 {{ $team->is_public ? 'bg-green-500/20 text-green-400 border border-green-500' : 'bg-gray-600/40 text-gray-300 border border-gray-500' }} rounded-full font-semibold">
                            <i class="fas {{ $team->is_public ? 'fa-globe' : 'fa-lock' }} mr-1"></i>
                            {{ $team->is_public ? 'Equipo Público' : 'Equipo Privado' }}
                        </span>
                        <span class="text-gray-400">
                            <i class="fas fa-users text-cb-green mr-1"></i>
                            {{ $team->current_members }} / {{ $team->max_members }} miembros
                        </span>
                    </div>
                </div>

                {{-- Líder del Equipo --}}
                <div class="p-6 border-b border-cb-border">
                    <h4 class="text-white font-bold mb-4 flex items-center">
                        <i class="fas fa-crown text-yellow-400 mr-2"></i>
                        Líder del Equipo
                    </h4>
                    <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($team->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-white font-medium">{{ $team->user->name }}</p>
                            <p class="text-gray-400 text-sm">{{ $team->user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Miembros del Equipo --}}
                <div class="p-6">
                    <h4 class="text-white font-bold mb-4 flex items-center">
                        <i class="fas fa-users text-cb-green mr-2"></i>
                        Miembros del Equipo ({{ $team->current_members }})
                    </h4>

                    @if($team->members->count() > 0)
                        <div class="space-y-3">
                            @foreach($team->members as $member)
                                <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($member->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium">{{ $member->user->name }}</p>
                                        <p class="text-gray-400 text-sm">{{ $member->user->email }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-500/20 text-green-400 border border-green-500 rounded-full text-xs font-semibold">
                                        Miembro
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-4">Solo el líder está en el equipo</p>
                    @endif

                    {{-- Espacios Vacíos --}}
                    @if($team->current_members < $team->max_members)
                        <div class="mt-4 space-y-2">
                            @for($i = $team->current_members; $i < $team->max_members; $i++)
                                <div class="flex items-center space-x-4 p-4 bg-cb-dark/30 rounded-lg border-2 border-dashed border-cb-border">
                                    <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-gray-500">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <p class="text-gray-500 italic">Espacio disponible</p>
                                </div>
                            @endfor
                        </div>
                    @endif
                </div>

                {{-- Botón de Unirse --}}
                @if(!$team->hasUser(Auth::id()))
                    <div class="p-6 border-t border-cb-border bg-cb-dark/30">
                        @if($team->isFull())
                            <button disabled class="w-full bg-gray-600 text-gray-400 font-bold py-3 px-6 rounded-lg cursor-not-allowed">
                                <i class="fas fa-users-slash mr-2"></i>
                                Equipo Completo
                            </button>
                        @else
                            <form method="POST" action="{{ route('teams.join', $team->id) }}">
                                @csrf
                                <button type="submit" class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-6 rounded-lg transition">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Unirme al Equipo
                                </button>
                            </form>
                        @endif
                    </div>
                @else
                    <div class="p-6 border-t border-cb-border bg-green-500/10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-green-400">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <span class="font-bold">Ya eres miembro de este equipo</span>
                            </div>
                            @if($team->user_id != Auth::id())
                                <form method="POST" action="{{ route('teams.leave', $team->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500 rounded-lg transition" onclick="return confirm('¿Seguro que quieres salir del equipo?')">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Salir del Equipo
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Botón para volver --}}
            <div class="text-center">
                <a href="{{ route('profile.index') }}" class="inline-block px-6 py-3 bg-cb-border hover:bg-gray-600 text-white font-bold rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver a Mi Perfil
                </a>
            </div>

        </div>
    </div>
</x-app-layout>