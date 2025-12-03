<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-trophy text-cb-green mr-2"></i>
                Detalles del Concurso
            </h2>
            <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-white transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes de éxito/error --}}
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

            {{-- Información Principal del Concurso --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <div class="flex flex-col lg:flex-row gap-8">
                    {{-- Columna Izquierda --}}
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if ($contest->status == 'Activo') bg-cb-green/20 text-cb-green border border-cb-green
                                @elseif ($contest->status == 'Próximamente') bg-blue-900/40 text-blue-300 border border-blue-600
                                @else bg-gray-600/40 text-gray-300 border border-gray-500
                                @endif
                            ">
                                {{ $contest->status }}
                            </span>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if ($contest->difficulty == 'Difícil') bg-red-900/40 text-red-300
                                @elseif ($contest->difficulty == 'Medio') bg-yellow-900/40 text-yellow-300
                                @else bg-green-900/40 text-green-300
                                @endif
                            ">
                                {{ $contest->difficulty }}
                            </span>
                        </div>

                        <h1 class="text-4xl font-bold text-white mb-4">{{ $contest->name }}</h1>
                        <p class="text-gray-400 text-lg mb-6">{{ $contest->description }}</p>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-cb-dark/50 p-4 rounded-lg">
                                <div class="flex items-center space-x-2 text-cb-green mb-2">
                                    <i class="far fa-clock"></i>
                                    <span class="text-sm font-medium">Duración</span>
                                </div>
                                <p class="text-white font-bold">{{ $contest->duration }}</p>
                            </div>

                            <div class="bg-cb-dark/50 p-4 rounded-lg">
                                <div class="flex items-center space-x-2 text-cb-green mb-2">
                                    <i class="fas fa-users"></i>
                                    <span class="text-sm font-medium">Participantes</span>
                                </div>
                                <p class="text-white font-bold">{{ number_format($contest->participants) }}</p>
                            </div>

                            <div class="bg-cb-dark/50 p-4 rounded-lg">
                                <div class="flex items-center space-x-2 text-cb-green mb-2">
                                    <i class="fas fa-trophy"></i>
                                    <span class="text-sm font-medium">Premio</span>
                                </div>
                                <p class="text-white font-bold">${{ number_format($contest->prize) }}</p>
                            </div>

                            <div class="bg-cb-dark/50 p-4 rounded-lg">
                                <div class="flex items-center space-x-2 text-cb-green mb-2">
                                    <i class="far fa-calendar"></i>
                                    <span class="text-sm font-medium">Fecha</span>
                                </div>
                                <p class="text-white font-bold">{{ $contest->start_date->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-white mb-3">
                                <i class="fas fa-code text-cb-green mr-2"></i>
                                Lenguajes Permitidos
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($contest->languages as $lang)
                                    <span class="text-sm bg-cb-border text-gray-300 px-3 py-1 rounded-full">
                                        {{ $lang }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Columna Derecha - Equipo --}}
                    <div class="lg:w-96">
                        <div class="bg-cb-dark/50 rounded-lg p-6 border border-cb-border">
                            <h3 class="text-lg font-bold text-white mb-4">
                                <i class="fas fa-user-friends text-cb-green mr-2"></i>
                                Configuración de Equipo
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">Mínimo de integrantes:</span>
                                    <span class="text-white font-bold">{{ $contest->min_team_members }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-400">Máximo de integrantes:</span>
                                    <span class="text-white font-bold">{{ $contest->max_team_members }}</span>
                                </div>
                            </div>

                            @if($isRegistered)
                                <div class="mt-6 p-4 bg-green-500/10 border border-green-500 rounded-lg">
                                    <div class="flex items-center space-x-2 text-green-400 mb-2">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="font-bold">Ya estás registrado</span>
                                    </div>
                                    <p class="text-sm text-gray-400">Equipo: {{ $registration->team_name }}</p>
                                </div>
                            @else
                                <button 
                                    onclick="document.getElementById('registration-form').scrollIntoView({ behavior: 'smooth' })"
                                    class="w-full mt-6 py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition duration-300"
                                >
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Participar Ahora
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reglas y Requisitos --}}
            <div class="grid lg:grid-cols-2 gap-6">
                <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-list-check text-cb-green mr-3"></i>
                        Reglas del Concurso
                    </h3>
                    <p class="text-gray-400">{{ $contest->rules ?? 'No hay reglas específicas publicadas aún.' }}</p>
                </div>

                <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-clipboard-list text-cb-green mr-3"></i>
                        Requisitos
                    </h3>
                    <p class="text-gray-400">{{ $contest->requirements ?? 'No hay requisitos específicos.' }}</p>
                </div>
            </div>

            {{-- Formulario de Registro --}}
            @if(!$isRegistered)
                <div id="registration-form" class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-edit text-cb-green mr-3"></i>
                        Formulario de Inscripción
                    </h3>

                    <form method="POST" action="{{ route('contests.register', $contest->id) }}" id="contest-form">
                        @csrf

                        {{-- Nombre del Equipo --}}
                        <div class="mb-6">
                            <label for="team_name" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-users mr-2"></i>
                                Nombre del Equipo *
                            </label>
                            <input 
                                type="text" 
                                id="team_name" 
                                name="team_name" 
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent"
                                placeholder="Ej: Los Coders"
                            >
                            @error('team_name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Cantidad de Integrantes --}}
                        <div class="mb-6">
                            <label for="team_size" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-hashtag mr-2"></i>
                                Cantidad de Integrantes ({{ $contest->min_team_members }} - {{ $contest->max_team_members }}) *
                            </label>
                            <input 
                                type="number" 
                                id="team_size" 
                                name="team_size" 
                                min="{{ $contest->min_team_members }}" 
                                max="{{ $contest->max_team_members }}" 
                                required
                                onchange="updateMemberFields()"
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent"
                            >
                            @error('team_size')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Teléfono del Líder --}}
                        <div class="mb-6">
                            <label for="leader_phone" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-phone mr-2"></i>
                                Teléfono del Líder *
                            </label>
                            <input 
                                type="tel" 
                                id="leader_phone" 
                                name="leader_phone" 
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent"
                                placeholder="Ej: +52 123 456 7890"
                            >
                            <p class="text-gray-500 text-xs mt-1">El líder será el contacto principal del equipo</p>
                            @error('leader_phone')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Integrantes del Equipo --}}
                        <div class="mb-6">
                            <h4 class="text-lg font-bold text-white mb-4">
                                <i class="fas fa-id-card text-cb-green mr-2"></i>
                                Datos de los Integrantes
                            </h4>
                            <div id="members-container" class="space-y-4">
                                <!-- Los campos se generarán dinámicamente con JavaScript -->
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="flex gap-4">
                            <button 
                                type="submit"
                                class="flex-1 py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition duration-300"
                            >
                                <i class="fas fa-check mr-2"></i>
                                Confirmar Inscripción
                            </button>
                            <a 
                                href="{{ route('welcome') }}"
                                class="flex-1 py-3 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg transition duration-300 text-center"
                            >
                                <i class="fas fa-times mr-2"></i>
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            @else
                {{-- Opciones si ya está registrado --}}
                <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-info-circle text-cb-green mr-3"></i>
                        Información de tu Registro
                    </h3>

                    <div class="bg-cb-dark/50 rounded-lg p-6 mb-6">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Nombre del Equipo</p>
                                <p class="text-white font-bold">{{ $registration->team_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Integrantes</p>
                                <p class="text-white font-bold">{{ $registration->team_size }} miembros</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Teléfono del Líder</p>
                                <p class="text-white font-bold">{{ $registration->leader_phone }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Estado</p>
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-lg text-sm font-medium">
                                    Registrado
                                </span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-gray-400 text-sm mb-3">Miembros del Equipo:</p>
                            <div class="space-y-2">
                                @foreach($registration->team_members as $index => $member)
                                    <div class="flex items-center space-x-3 bg-cb-card p-3 rounded-lg">
                                        <div class="w-10 h-10 bg-cb-green/10 rounded-full flex items-center justify-center">
                                            <span class="text-cb-green font-bold">{{ $index + 1 }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-white font-medium">{{ $member['name'] }}</p>
                                            <p class="text-gray-400 text-sm">Nacimiento: {{ \Carbon\Carbon::parse($member['birthdate'])->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('contests.cancel', $contest->id) }}" onsubmit="return confirm('¿Estás seguro de que quieres cancelar tu inscripción?')">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            class="w-full py-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500 font-bold rounded-lg transition duration-300"
                        >
                            <i class="fas fa-trash mr-2"></i>
                            Cancelar Inscripción
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>

    @push('scripts')
    <script>
        function updateMemberFields() {
            const teamSize = parseInt(document.getElementById('team_size').value);
            const container = document.getElementById('members-container');
            
            if (!teamSize || teamSize < {{ $contest->min_team_members }} || teamSize > {{ $contest->max_team_members }}) {
                container.innerHTML = '<p class="text-gray-400">Por favor, ingresa una cantidad válida de integrantes.</p>';
                return;
            }
            
            container.innerHTML = '';
            
            for (let i = 0; i < teamSize; i++) {
                const memberDiv = document.createElement('div');
                memberDiv.className = 'bg-cb-dark/50 rounded-lg p-4 border border-cb-border';
                memberDiv.innerHTML = `
                    <h5 class="text-white font-bold mb-3">
                        <i class="fas fa-user text-cb-green mr-2"></i>
                        Integrante ${i + 1} ${i === 0 ? '(Líder)' : ''}
                    </h5>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Nombre Completo *
                            </label>
                            <input 
                                type="text" 
                                name="members[${i}][name]" 
                                required
                                class="w-full px-4 py-2 bg-cb-card border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                                placeholder="Juan Pérez"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Fecha de Nacimiento *
                            </label>
                            <input 
                                type="date" 
                                name="members[${i}][birthdate]" 
                                required
                                max="${new Date().toISOString().split('T')[0]}"
                                class="w-full px-4 py-2 bg-cb-card border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                        </div>
                    </div>
                `;
                container.appendChild(memberDiv);
            }
        }
    </script>
    @endpush
</x-app-layout>