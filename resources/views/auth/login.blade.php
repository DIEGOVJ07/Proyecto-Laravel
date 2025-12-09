<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Iniciar Sesión - CodeBattle</title>
    
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

        {{-- Formulario de Login --}}
        <div class="w-full max-w-md">
            <div class="bg-cb-card rounded-2xl shadow-2xl border border-cb-border p-8">
                
                {{-- Tabs --}}
                <div class="flex mb-8 bg-cb-dark rounded-lg p-1">
                    <button class="flex-1 py-2 px-4 bg-cb-green text-cb-dark rounded-lg font-semibold transition-all">
                        Iniciar Sesión
                    </button>
                    <a href="{{ route('register') }}" class="flex-1 py-2 px-4 text-gray-400 hover:text-white rounded-lg font-semibold text-center transition-all">
                        Registrarse
                    </a>
                </div>

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-500/10 border border-red-500 rounded-lg">
                        <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                    </div>
                @endif

                {{-- Mensaje de sesión --}}
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-500/10 border border-green-500 rounded-lg">
                        <p class="text-green-400 text-sm">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                                value="{{ old('email') }}"
                                required 
                                autofocus
                                placeholder="tu@email.com"
                                class="w-full pl-10 pr-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent transition-all"
                            >
                        </div>
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
                                placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green focus:border-transparent transition-all"
                            >
                        </div>
                    </div>

                    {{-- Remember me y Forgot password --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="remember"
                                class="w-4 h-4 bg-cb-dark border-cb-border rounded text-cb-green focus:ring-cb-green focus:ring-2"
                            >
                            <span class="ml-2 text-sm text-gray-400">Recordarme</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-cb-green hover:text-green-400 transition-colors">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    {{-- Botón de login --}}
                    <button 
                        type="submit"
                        class="w-full py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl"
                    >
                        Iniciar Sesión
                    </button>
                </form>


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