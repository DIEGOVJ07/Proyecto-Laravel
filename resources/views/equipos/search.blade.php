    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-search text-cb-green mr-2"></i>
            Buscar Equipo
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes --}}
            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Buscador por código --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8 mb-8">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-4xl text-cb-green"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Únete a un Equipo</h3>
                    <p class="text-gray-400">Ingresa el código de 5 dígitos que te compartió tu equipo</p>
                </div>

                <form method="POST" action="{{ route('equipos.search') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-gray-300 font-medium mb-2">Código del Equipo</label>
                        <input type="text" 
                            name="team_code" 
                            maxlength="5" 
                            required
                            placeholder="Ej: A1B2C"
                            class="w-full bg-cb-dark border border-cb-border rounded-lg px-6 py-4 text-white text-center text-2xl font-bold uppercase tracking-widest focus:border-cb-green focus:ring focus:ring-cb-green/20 transition"
                            style="letter-spacing: 0.5em;">
                        @error('team_code')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-4 px-6 rounded-lg transition text-lg">
                        <i class="fas fa-search mr-2"></i>
                        Buscar Equipo
                    </button>
                </form>
            </div>

            {{-- Consejos --}}
            <div class="bg-blue-500/10 border border-blue-500 rounded-lg p-6">
                <h4 class="text-white font-bold mb-3 flex items-center">
                    <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                    Consejos
                </h4>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-check text-cb-green mr-2 mt-1"></i>
                        <span>El código de equipo distingue entre mayúsculas y minúsculas</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-cb-green mr-2 mt-1"></i>
                        <span>Solo puedes estar en un equipo por concurso</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-cb-green mr-2 mt-1"></i>
                        <span>Verifica que el equipo tenga espacios disponibles</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
