<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-user-plus mr-2 text-purple-400"></i>
                Crear Nuevo Usuario
            </h2>
            <a href="{{ route('admin.usuarios.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-8">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-6 py-4 rounded-lg">
                        <div class="font-bold mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            Hay errores en el formulario:
                        </div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.usuarios.store') }}" class="space-y-6">
                    @csrf

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user mr-2"></i>Nombre Completo <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Correo Electrónico <span class="text-red-400">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rol -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user-tag mr-2"></i>Rol <span class="text-red-400">*</span>
                        </label>
                        <select name="role" 
                                id="role"
                                required
                                class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cb-green @error('role') border-red-500 @enderror">
                            <option value="">Selecciona un rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    @if($role->name == 'super_admin')
                                        🛡️ Super Administrador
                                    @elseif($role->name == 'admin')
                                        👑 Administrador
                                    @elseif($role->name == 'juez')
                                        ⚖️ Juez
                                    @else
                                        👤 Usuario
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Selecciona cuidadosamente el rol. Los Super Admins tienen control total del sistema.
                        </p>
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2"></i>Contraseña <span class="text-red-400">*</span>
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               required
                               class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-400">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Debe tener al menos 8 caracteres.
                        </p>
                    </div>

                    <!-- Confirmar contraseña -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2"></i>Confirmar Contraseña <span class="text-red-400">*</span>
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               required
                               class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green">
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-cb-border">
                        <a href="{{ route('admin.usuarios.index') }}" 
                           class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all font-medium">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-cb-green text-white rounded-lg hover:bg-cb-green/80 transition-all font-medium">
                            <i class="fas fa-save mr-2"></i>Crear Usuario
                        </button>
                    </div>
                </form>
            </div>

            <!-- Información de roles -->
            <div class="mt-6 bg-cb-card rounded-lg shadow-xl border border-cb-border p-6">
                <h3 class="text-lg font-semibold text-white mb-4">
                    <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                    Descripción de Roles
                </h3>
                <div class="space-y-3 text-sm text-gray-300">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-shield-halved text-purple-400 mt-1"></i>
                        <div>
                            <strong class="text-purple-400">Super Administrador:</strong>
                            Control total del sistema, gestión de usuarios, asignación de roles y configuración crítica.
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-crown text-yellow-400 mt-1"></i>
                        <div>
                            <strong class="text-yellow-400">Administrador:</strong>
                            Gestión de concursos, jueces y equipos. No puede modificar usuarios ni configuración del sistema.
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-gavel text-blue-400 mt-1"></i>
                        <div>
                            <strong class="text-blue-400">Juez:</strong>
                            Evaluación y calificación de equipos en concursos asignados.
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-user text-gray-400 mt-1"></i>
                        <div>
                            <strong class="text-gray-400">Usuario:</strong>
                            Participante estándar que puede inscribirse en concursos.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
