<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-edit text-cb-green mr-2"></i>
                Editar Juez: {{ $judge->name }}
            </h2>
            <a href="{{ route('admin.judges.index') }}" class="px-4 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <form method="POST" action="{{ route('admin.judges.update', $judge) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Información Personal --}}
                    <div class="border-b border-cb-border pb-6">
                        <h3 class="text-xl font-bold text-white mb-4">
                            <i class="fas fa-user mr-2 text-cb-green"></i>
                            Información Personal
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Nombre --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Nombre Completo *</label>
                                <input type="text" name="name" value="{{ old('name', $judge->name) }}" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                @error('name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Correo Electrónico *</label>
                                <input type="email" name="email" value="{{ old('email', $judge->email) }}" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                @error('email')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Teléfono --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Teléfono</label>
                                <input type="text" name="phone" value="{{ old('phone', $judge->phone) }}"
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                @error('phone')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Institución --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Institución/Empresa</label>
                                <input type="text" name="institution" value="{{ old('institution', $judge->institution) }}"
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                @error('institution')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Información Profesional --}}
                    <div class="border-b border-cb-border pb-6">
                        <h3 class="text-xl font-bold text-white mb-4">
                            <i class="fas fa-briefcase mr-2 text-cb-green"></i>
                            Información Profesional
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            {{-- Especialidad --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Especialidad *</label>
                                <select name="specialty" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                    <option value="">Seleccionar...</option>
                                    <option value="Algoritmos" {{ old('specialty', $judge->specialty) == 'Algoritmos' ? 'selected' : '' }}>Algoritmos</option>
                                    <option value="Estructuras de Datos" {{ old('specialty', $judge->specialty) == 'Estructuras de Datos' ? 'selected' : '' }}>Estructuras de Datos</option>
                                    <option value="Programación Dinámica" {{ old('specialty', $judge->specialty) == 'Programación Dinámica' ? 'selected' : '' }}>Programación Dinámica</option>
                                    <option value="Grafos" {{ old('specialty', $judge->specialty) == 'Grafos' ? 'selected' : '' }}>Grafos</option>
                                    <option value="Matemáticas" {{ old('specialty', $judge->specialty) == 'Matemáticas' ? 'selected' : '' }}>Matemáticas</option>
                                    <option value="Inteligencia Artificial" {{ old('specialty', $judge->specialty) == 'Inteligencia Artificial' ? 'selected' : '' }}>Inteligencia Artificial</option>
                                    <option value="Bases de Datos" {{ old('specialty', $judge->specialty) == 'Bases de Datos' ? 'selected' : '' }}>Bases de Datos</option>
                                    <option value="Desarrollo Web" {{ old('specialty', $judge->specialty) == 'Desarrollo Web' ? 'selected' : '' }}>Desarrollo Web</option>
                                </select>
                                @error('specialty')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nivel de Certificación --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Nivel de Certificación *</label>
                                <select name="certification_level" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                    <option value="">Seleccionar...</option>
                                    <option value="Junior" {{ old('certification_level', $judge->certification_level) == 'Junior' ? 'selected' : '' }}>🎯 Junior</option>
                                    <option value="Senior" {{ old('certification_level', $judge->certification_level) == 'Senior' ? 'selected' : '' }}>⭐ Senior</option>
                                    <option value="Expert" {{ old('certification_level', $judge->certification_level) == 'Expert' ? 'selected' : '' }}>🏆 Expert</option>
                                </select>
                                @error('certification_level')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Años de Experiencia --}}
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Años de Experiencia *</label>
                                <input type="number" name="experience_years" value="{{ old('experience_years', $judge->experience_years) }}" min="0" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                @error('experience_years')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Estado Activo --}}
                            <div class="flex items-center">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $judge->is_active) ? 'checked' : '' }}
                                        class="w-5 h-5 bg-cb-dark border-cb-border rounded text-cb-green focus:ring-cb-green focus:ring-offset-cb-card">
                                    <span class="text-gray-300 font-medium">Juez Activo</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Biografía --}}
                    <div>
                        <label class="block text-gray-300 font-medium mb-2">Biografía/Experiencia</label>
                        <textarea name="bio" rows="4"
                            class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition"
                            placeholder="Describe la experiencia y logros del juez...">{{ old('bio', $judge->bio) }}</textarea>
                        @error('bio')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-cb-border">
                        <a href="{{ route('admin.judges.index') }}" class="px-6 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Juez
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>