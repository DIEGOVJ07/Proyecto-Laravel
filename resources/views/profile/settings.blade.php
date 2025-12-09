<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-white leading-tight">
                    <i class="fas fa-cog text-cb-green mr-2"></i>
                    Configuración de Cuenta
                </h2>
                <p class="text-gray-400 text-sm mt-1">Administra tu información personal y preferencias</p>
            </div>
            <a href="{{ route('profile.index') }}" class="px-4 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver al Perfil
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes de Éxito --}}
            @if(session('status'))
                <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') == 'profile-updated' ? 'Perfil actualizado correctamente' : session('status') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Información del Perfil --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-2xl font-bold text-cb-dark">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                        <p class="text-gray-400">{{ $user->email }}</p>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-user-edit text-cb-green mr-2"></i>
                    Información Personal
                </h3>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- Nombre --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user mr-2 text-cb-green"></i>
                            Nombre Completo
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $user->name) }}"
                            class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring-2 focus:ring-cb-green/20 transition"
                            required
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2 text-cb-green"></i>
                            Correo Electrónico
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $user->email) }}"
                            class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring-2 focus:ring-cb-green/20 transition"
                            required
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror

                        @if ($user->isDirty('email'))
                            <p class="mt-2 text-sm text-yellow-400">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Tu dirección de correo no estará verificada hasta que confirmes el cambio.
                            </p>
                        @endif
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-cb-border">
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-emerald-600 transition shadow-lg"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

            {{-- Cambiar Contraseña --}}
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-lock text-cb-green mr-2"></i>
                    Cambiar Contraseña
                </h3>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Contraseña Actual --}}
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-key mr-2 text-cb-green"></i>
                            Contraseña Actual
                        </label>
                        <input 
                            type="password" 
                            name="current_password" 
                            id="current_password" 
                            class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring-2 focus:ring-cb-green/20 transition"
                            autocomplete="current-password"
                        >
                        @error('current_password', 'updatePassword')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nueva Contraseña --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2 text-cb-green"></i>
                            Nueva Contraseña
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring-2 focus:ring-cb-green/20 transition"
                            autocomplete="new-password"
                        >
                        @error('password', 'updatePassword')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-400">Mínimo 8 caracteres</p>
                    </div>

                    {{-- Confirmar Contraseña --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-check-double mr-2 text-cb-green"></i>
                            Confirmar Nueva Contraseña
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring-2 focus:ring-cb-green/20 transition"
                            autocomplete="new-password"
                        >
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-cb-border">
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-emerald-600 transition shadow-lg"
                        >
                            <i class="fas fa-key mr-2"></i>
                            Actualizar Contraseña
                        </button>
                    </div>
                </form>
            </div>

            {{-- Zona de Peligro --}}
            <div class="bg-red-900/10 rounded-xl shadow-xl border border-red-500/30 p-8">
                <h3 class="text-lg font-bold text-red-400 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Zona de Peligro
                </h3>
                
                <p class="text-gray-300 mb-6">
                    Una vez eliminada tu cuenta, todos tus datos se eliminarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier información que desees conservar.
                </p>

                <button 
                    type="button" 
                    onclick="document.getElementById('delete-modal').classList.remove('hidden')"
                    class="px-6 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition"
                >
                    <i class="fas fa-trash-alt mr-2"></i>
                    Eliminar Cuenta
                </button>
            </div>

        </div>
    </div>

    {{-- Modal de Confirmación de Eliminación --}}
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
        <div class="bg-cb-card rounded-xl shadow-2xl border border-red-500/50 max-w-md w-full p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">¿Eliminar tu cuenta?</h3>
                <p class="text-gray-400">Esta acción no se puede deshacer. Todos tus datos se eliminarán permanentemente.</p>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Confirma tu contraseña para continuar
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password_delete" 
                        class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 transition"
                        placeholder="Tu contraseña"
                    >
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-4">
                    <button 
                        type="button" 
                        onclick="document.getElementById('delete-modal').classList.add('hidden')"
                        class="flex-1 px-4 py-3 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition"
                    >
                        Cancelar
                    </button>
                    <button 
                        type="submit" 
                        class="flex-1 px-4 py-3 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition"
                    >
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
