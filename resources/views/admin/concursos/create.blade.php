<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-plus-circle text-cb-green mr-2"></i>
                Crear Nuevo Concurso
            </h2>
            <a href="{{ route('admin.concursos.index') }}" class="px-4 py-2 bg-cb-border text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <form method="POST" action="{{ route('admin.concursos.store') }}">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-trophy text-cb-green mr-2"></i>
                            Nombre del Concurso *
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Ej: Weekly Challenge #48"
                        >
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-align-left text-cb-green mr-2"></i>
                            Descripción *
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="3"
                            required
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Descripción breve del concurso"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Estado y Dificultad --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-info-circle text-cb-green mr-2"></i>
                                Estado *
                            </label>
                            <select 
                                id="status" 
                                name="status" 
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                                <option value="Activo" {{ old('status') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Próximamente" {{ old('status') == 'Próximamente' ? 'selected' : '' }}>Próximamente</option>
                                <option value="Finalizado" {{ old('status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                            @error('status')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-chart-bar text-cb-green mr-2"></i>
                                Dificultad *
                            </label>
                            <select 
                                id="difficulty" 
                                name="difficulty" 
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                                <option value="Fácil" {{ old('difficulty') == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                                <option value="Medio" {{ old('difficulty') == 'Medio' ? 'selected' : '' }}>Medio</option>
                                <option value="Difícil" {{ old('difficulty') == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                            </select>
                            @error('difficulty')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Duración y Premio --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="far fa-clock text-cb-green mr-2"></i>
                                Duración *
                            </label>
                            <input 
                                type="text" 
                                id="duration" 
                                name="duration" 
                                value="{{ old('duration') }}"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                                placeholder="Ej: 2 horas"
                            >
                            @error('duration')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="prize" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-dollar-sign text-cb-green mr-2"></i>
                                Premio (USD) *
                            </label>
                            <input 
                                type="number" 
                                id="prize" 
                                name="prize" 
                                value="{{ old('prize') }}"
                                min="0"
                                step="0.01"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                                placeholder="1000"
                            >
                            @error('prize')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Fechas --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="far fa-calendar-alt text-cb-green mr-2"></i>
                                Fecha de Inicio *
                            </label>
                            <input 
                                type="date" 
                                id="start_date" 
                                name="start_date" 
                                value="{{ old('start_date') }}"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            @error('start_date')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="far fa-calendar-check text-cb-green mr-2"></i>
                                Fecha de Fin *
                            </label>
                            <input 
                                type="date" 
                                id="end_date" 
                                name="end_date" 
                                value="{{ old('end_date') }}"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            @error('end_date')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Lenguajes permitidos --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-code text-cb-green mr-2"></i>
                            Lenguajes Permitidos * (Selecciona al menos uno)
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['Python', 'Java', 'C++', 'JavaScript', 'C#', 'Ruby', 'Go', 'Rust'] as $lang)
                                <label class="flex items-center space-x-2 bg-cb-dark p-3 rounded-lg cursor-pointer hover:bg-cb-border transition">
                                    <input 
                                        type="checkbox" 
                                        name="languages[]" 
                                        value="{{ $lang }}"
                                        {{ is_array(old('languages')) && in_array($lang, old('languages')) ? 'checked' : '' }}
                                        class="w-4 h-4 text-cb-green bg-cb-card border-cb-border rounded focus:ring-cb-green"
                                    >
                                    <span class="text-white text-sm">{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('languages')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Integrantes del equipo --}}
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="min_team_members" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-users text-cb-green mr-2"></i>
                                Mínimo de Integrantes *
                            </label>
                            <input 
                                type="number" 
                                id="min_team_members" 
                                name="min_team_members" 
                                value="{{ old('min_team_members', 1) }}"
                                min="1"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            @error('min_team_members')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="max_team_members" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-user-friends text-cb-green mr-2"></i>
                                Máximo de Integrantes *
                            </label>
                            <input 
                                type="number" 
                                id="max_team_members" 
                                name="max_team_members" 
                                value="{{ old('max_team_members', 5) }}"
                                min="1"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            @error('max_team_members')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Reglas --}}
                    <div class="mb-6">
                        <label for="rules" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-list-check text-cb-green mr-2"></i>
                            Reglas del Concurso
                        </label>
                        <textarea 
                            id="rules" 
                            name="rules" 
                            rows="4"
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Describe las reglas del concurso..."
                        >{{ old('rules') }}</textarea>
                        @error('rules')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Requisitos --}}
                    <div class="mb-6">
                        <label for="requirements" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-clipboard-list text-cb-green mr-2"></i>
                            Requisitos
                        </label>
                        <textarea 
                            id="requirements" 
                            name="requirements" 
                            rows="4"
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Describe los requisitos para participar..."
                        >{{ old('requirements') }}</textarea>
                        @error('requirements')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="flex gap-4">
                        <button 
                            type="submit"
                            class="flex-1 py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition duration-300"
                        >
                            <i class="fas fa-check mr-2"></i>
                            Crear Concurso
                        </button>
                        <a 
                            href="{{ route('admin.concursos.index') }}"
                            class="flex-1 py-3 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg transition duration-300 text-center"
                        >
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
