<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Registrarse - CodeBattle</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cb-dark': '#0D1421',
                        'cb-card': '#141D2D',
                        'cb-green': '#10B981',
                        'cb-border': '#29374D',
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-cb-dark text-white">
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Logo y título --}}
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-cb-green to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                <i class="fas fa-terminal text-4xl text-cb-dark"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">CodeArena</h1>
            <p class="text-gray-400">Únete a la competencia y demuestra tus habilidades</p>
        </div>

        {{-- Formulario de Registro --}}
        <div class="w-full max-w-md">
            <div class="bg-cb-card rounded-2xl shadow-2xl border border-cb-border p-8">
                
                {{-- Tabs --}}
                <div class="flex mb-8 bg-cb-dark rounded-lg p-1">
                    <a href="{{ route('login') }}" class="flex-1 py-2 px-4 text-gray-400 hover:text-white rounded-lg font-semibold text-center transition-all">
                        Iniciar Sesión
                    </a>
                    <button class="flex-1 py-2 px-4 bg-cb-green text-cb-dark rounded-lg font-semibold transition-all">
                        Registrarse
                    </button>
                </div>

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-500/10 border border-red-500 rounded-lg">
                        <ul class="list-disc list-inside text-red-400 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            Nombre Completo
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                required 
                                autofocus
                                autocomplete="name"
                                placeholder="Juan Pérez"
                                class="w-full pl-10 pr-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent transition-all"
                            >
                        </div>
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-500"></i>
                            </div>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ strtolower(old('email')) }}"
                                required
                                autocomplete="email"
                                placeholder="tu@email.com"
                                oninput="this.value = this.value.toLowerCase()"
                                class="w-full pl-10 pr-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent transition-all lowercase"
                            >
                        </div>
                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required
                                autocomplete="new-password"
                                placeholder="Mínimo 8 caracteres"
                                class="w-full pl-10 pr-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent transition-all"
                            >
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Debe tener al menos 8 caracteres</p>
                        @error('password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                            Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                required
                                autocomplete="new-password"
                                placeholder="Repite tu contraseña"
                                class="w-full pl-10 pr-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent transition-all"
                            >
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Términos y condiciones --}}
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="terms"
                                required
                                class="w-4 h-4 mt-1 bg-cb-dark border-cb-border rounded text-cb-green focus:ring-cb-green focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-400">
                                Acepto los 
                                <a href="#" class="text-cb-green hover:text-green-400 transition-colors">términos y condiciones</a>
                                y la 
                                <a href="#" class="text-cb-green hover:text-green-400 transition-colors">política de privacidad</a>
                            </span>
                        </label>
                    </div>

                    {{-- Botón de registro --}}
                    <button 
                        type="submit"
                        class="w-full py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Crear Cuenta
                    </button>
                </form>
                {{-- Ya tienes cuenta --}}
                <div class="mt-6 text-center">
                    <p class="text-gray-400 text-sm">
                        ¿Ya tienes una cuenta? 
                        <a href="{{ route('login') }}" class="text-cb-green hover:text-green-400 font-semibold transition-colors">
                            Inicia Sesión
                        </a>
                    </p>
                </div>
            </div>

            {{-- Link de ayuda --}}
            <div class="text-center mt-6">
                <p class="text-gray-500 text-sm">
                    ¿Necesitas ayuda? 
                    <a href="#" class="text-cb-green hover:text-green-400 transition-colors">
                        Contacta con soporte
                    </a>
                </p>
            </div>
        </div>

        {{-- Volver a inicio --}}
        <div class="mt-8">
            <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-white transition-colors flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Volver al inicio</span>
            </a>
        </div>
    </div>
</body>
</html>