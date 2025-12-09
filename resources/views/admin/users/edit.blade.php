<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-user-edit mr-2 text-purple-400"></i>
                Editar Usuario: {{ $user->name }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all text-sm font-medium">
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

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Información del usuario -->
                    <div class="bg-cb-dark rounded-lg p-4 border border-cb-border mb-6">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 h-16 w-16 bg-cb-green/20 rounded-full flex items-center justify-center">
                                @if($user->hasRole('super_admin'))
                                    <i class="fas fa-shield-halved text-purple-400 text-2xl"></i>
                                @elseif($user->hasRole('admin'))
                                    <i class="fas fa-crown text-yellow-400 text-2xl"></i>
                                @elseif($user->hasRole('juez'))
                                    <i class="fas fa-gavel text-blue-400 text-2xl"></i>
                                @else
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                @endif
                            </div>
                            <div>
                                <p class="text-white font-semibold text-lg">{{ $user->name }}</p>
                                <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Registrado: {{ $user->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user mr-2"></i>Nombre Completo <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name', $user->name) }}"
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
                               value="{{ old('email', $user->email) }}"
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
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role', $user->role) == $role->name ? 'selected' : '' }}>
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
                            Al cambiar el rol, los permisos del usuario se actualizarán automáticamente.
                        </p>
                    </div>

                    <!-- Aviso sobre contraseña -->
                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-400 mt-1"></i>
                            <div class="text-sm text-gray-300">
                                <p class="font-semibold text-blue-400 mb-1">Cambio de contraseña</p>
                                <p>Si el usuario necesita cambiar su contraseña, puede hacerlo desde su perfil personal o puedes solicitarle que use la opción de "Olvidé mi contraseña".</p>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-cb-border">
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all font-medium">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-cb-green text-white rounded-lg hover:bg-cb-green/80 transition-all font-medium">
                            <i class="fas fa-save mr-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

            <!-- Estadísticas del usuario -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Concursos</p>
                            <p class="text-2xl font-bold text-white">{{ $user->contestRegistrations()->count() }}</p>
                        </div>
                        <i class="fas fa-trophy text-3xl text-gray-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Puntos Totales</p>
                            <p class="text-2xl font-bold text-cb-green">{{ $user->leaderboard->points ?? 0 }}</p>
                        </div>
                        <i class="fas fa-star text-3xl text-gray-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Último Acceso</p>
                            <p class="text-sm font-semibold text-white">{{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                        <i class="fas fa-clock text-3xl text-gray-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
