<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeBattle - Plataforma de Programación Competitiva</title>
    
    {{-- Tailwind CSS desde CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Configuración de colores personalizados de CodeBattle --}}
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

    {{-- Countdown Timer Script --}}
@if($contests->count() > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @php
                $nextEvent = $contests->first(); // El primer concurso activo/próximo
            @endphp
            
            @if($nextEvent && $nextEvent->countdown_target)
                const targetTime = {{ $nextEvent->countdown_target }} * 1000;
                const timer = document.getElementById('countdown-timer');
                
                if (timer) {
                    const interval = setInterval(updateCountdown, 1000);

                    function updateCountdown() {
                        const now = new Date().getTime();
                        const distance = targetTime - now;

                        if (distance < 0) {
                            clearInterval(interval);
                            timer.innerHTML = "<span class='col-span-4 text-sm font-semibold'>¡El evento ha comenzado!</span>";
                            return;
                        }

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        timer.innerHTML = `
                            <div class="text-center">
                                <div class="text-2xl font-bold">${days}</div>
                                <div class="text-xs text-gray-400">Días</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">${hours}</div>
                                <div class="text-xs text-gray-400">Horas</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">${minutes}</div>
                                <div class="text-xs text-gray-400">Min</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">${seconds}</div>
                                <div class="text-xs text-gray-400">Seg</div>
                            </div>
                        `;
                    }
                    
                    updateCountdown(); // Llamada inicial
                }
            @endif
        });
    </script>
@endif

    {{-- Font Awesome para iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="font-sans antialiased bg-cb-dark text-white">
    <div class="min-h-screen">

        {{-- Navbar Fijo --}}
        <header class="sticky top-0 z-50 bg-cb-card shadow-lg border-b border-cb-border">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    {{-- Logo --}}
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="text-2xl font-extrabold text-cb-green flex items-center space-x-2">
                            <i class="fas fa-terminal"></i>
                            <span>CodeBattle</span>
                        </a>
                    </div>

                    {{-- Enlaces Centrales --}}
                    <nav class="hidden sm:flex sm:space-x-8">
                        <a href="{{ route('welcome') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('welcome') ? 'border-cb-green text-white' : 'border-transparent text-gray-300' }} text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                            Inicio
                        </a>
                        <a href="#concursos" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-300 hover:text-white hover:border-cb-green transition duration-150">
                            Concursos
                        </a>
                        @auth
                            <a href="{{ route('leaderboard.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('leaderboard.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300' }} text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                Clasificación
                            </a>
                            <a href="{{ route('profile.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('profile.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300' }} text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                Mi Perfil
                            </a>
                            <a href="{{ route('blog.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('blog.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300' }} text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                <i class="fas fa-blog mr-2"></i>
                                Blog
                            </a>
                            <a href="{{ route('venues.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('venues.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300' }} text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                Sedes
                            </a>
                        @endauth
                    </nav>

                    {{-- Botón de Acción --}}
                    <div class="flex items-center">
                        @auth
                            <a href="{{ route('profile.index') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 shadow-xl">
                                Ver Mi Perfil
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 shadow-xl">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- Contenido Principal --}}
        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

                {{-- Hero Section --}}
                <section class="text-center pt-10 pb-16">
                    <p class="text-cb-green font-semibold mb-4 text-sm uppercase tracking-wider">
                        # Plataforma de Programación Competitiva
                    </p>
                    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                        Codifica el futuro. <br>
                        <span class="text-cb-green">Gana hoy.</span>
                    </h1>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-8">
                        Únete a la comunidad de desarrolladores más competitiva. Resuelve desafíos, compite en tiempo real y lleva tus habilidades al siguiente nivel.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @auth
                            <a href="{{ route('profile.index') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                                Ver Mi Perfil →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                                Comenzar Ahora →
                            </a>
                        @endauth
                        <a href="#concursos" class="border-2 border-cb-border text-white hover:bg-cb-border py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                            Ver Concursos
                        </a>
                    </div>
                </section>

                {{-- Sección de Características --}}
                <section class="py-16">
                    <h2 class="text-3xl font-bold text-center mb-12 text-white">¿Por qué CodeBattle?</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-trophy text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Competencia Real</h3>
                            <p class="text-gray-400">Enfrenta a programadores de todo el mundo en desafíos en tiempo real</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Mejora Continua</h3>
                            <p class="text-gray-400">Rastrea tu progreso y mejora tus habilidades con cada desafío</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Comunidad Activa</h3>
                            <p class="text-gray-400">Únete a miles de desarrolladores apasionados por la programación</p>
                        </div>
                    </div>
                </section>

                {{-- Concursos Disponibles --}}
                <section id="concursos" class="py-20">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-extrabold text-white mb-4">
                            <i class="fas fa-trophy text-cb-green mr-3"></i>
                            Concursos Disponibles
                        </h2>
                        <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                            Elige tu desafío y demuestra tus habilidades de programación
                        </p>
                    </div>

                    @if($contests->count() > 0)
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($contests as $contest)
                                <div class="bg-cb-card rounded-xl shadow-2xl border border-cb-border hover:border-cb-green transition duration-300 overflow-hidden group">
                                    {{-- Header del concurso --}}
                                    <div class="bg-gradient-to-r from-cb-green/20 to-cb-dark p-6 border-b border-cb-border">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                                @if($contest->status == 'Activo') bg-cb-green/20 text-cb-green border border-cb-green
                                                @else bg-blue-900/40 text-blue-300 border border-blue-600
                                                @endif
                                            ">
                                                {{ $contest->status }}
                                            </span>
                                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                                @if($contest->difficulty == 'Difícil') bg-red-900/40 text-red-300 border border-red-600
                                                @elseif($contest->difficulty == 'Medio') bg-yellow-900/40 text-yellow-300 border border-yellow-600
                                                @else bg-green-900/40 text-green-300 border border-green-600
                                                @endif
                                            ">
                                                {{ $contest->difficulty }}
                                            </span>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white group-hover:text-cb-green transition">
                                            {{ $contest->name }}
                                        </h3>
                                    </div>

                                    {{-- Cuerpo del concurso --}}
                                    <div class="p-6 space-y-4">
                                        <p class="text-gray-400 text-sm line-clamp-2">
                                            {{ $contest->description }}
                                        </p>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-calendar text-cb-green"></i>
                                                <span class="text-gray-400">{{ $contest->start_date->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-clock text-cb-green"></i>
                                                <span class="text-gray-400">{{ $contest->duration }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-users text-cb-green"></i>
                                                <span class="text-gray-400">{{ $contest->participants }} personas</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-trophy text-cb-green"></i>
                                                <span class="text-gray-400">${{ number_format($contest->prize, 0) }}</span>
                                            </div>
                                        </div>

                                        {{-- Lenguajes --}}
                                        @if($contest->languages && count($contest->languages) > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach(array_slice($contest->languages, 0, 3) as $language)
                                                    <span class="px-2 py-1 bg-cb-green/10 text-cb-green border border-cb-green/30 rounded text-xs font-medium">
                                                        {{ $language }}
                                                    </span>
                                                @endforeach
                                                @if(count($contest->languages) > 3)
                                                    <span class="px-2 py-1 bg-gray-700 text-gray-400 rounded text-xs">
                                                        +{{ count($contest->languages) - 3 }} más
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        {{-- Botón de acción --}}
                                        @auth
                                            <a href="{{ route('contests.show', $contest->id) }}" class="block w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-4 rounded-lg text-center transition">
                                                Ver Detalles
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="block w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-4 rounded-lg text-center transition">
                                                Inicia Sesión para Participar
                                                <i class="fas fa-sign-in-alt ml-2"></i>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- No hay concursos --}}
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-trophy text-cb-green text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">
                                No hay concursos disponibles en este momento
                            </h3>
                            <p class="text-gray-400 mb-8">
                                Los nuevos desafíos se publicarán pronto. ¡Mantente atento!
                            </p>
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.contests.create') }}" class="inline-block bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                                        <i class="fas fa-plus mr-2"></i>
                                        Crear Primer Concurso
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </section>

            </div>
        </main>

        {{-- Footer --}}
        <footer class="mt-20 border-t border-cb-border bg-cb-card pt-10 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {{-- Logo y Descripción --}}
                    <div>
                        <div class="text-2xl font-extrabold text-cb-green mb-3 flex items-center space-x-2">
                            <i class="fas fa-terminal"></i>
                            <span>CodeBattle</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            La plataforma líder de programación competitiva en México y Latinoamérica.
                        </p>
                        <div class="flex space-x-4 text-gray-400">
                            <a href="#" class="hover:text-cb-green transition"><i class="fab fa-twitter text-xl"></i></a>
                            <a href="#" class="hover:text-cb-green transition"><i class="fab fa-github text-xl"></i></a>
                            <a href="#" class="hover:text-cb-green transition"><i class="fab fa-linkedin text-xl"></i></a>
                            <a href="#" class="hover:text-cb-green transition"><i class="fas fa-envelope text-xl"></i></a>
                        </div>
                    </div>

                    {{-- Plataforma --}}
                    <div>
                        <h5 class="text-white font-bold mb-4">Plataforma</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Cómo funciona</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Reglas y términos</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Preguntas frecuentes</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Documentación</a></li>
                        </ul>
                    </div>

                    {{-- Comunidad --}}
                    <div>
                        <h5 class="text-white font-bold mb-4">Comunidad</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Discord</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Foro</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Tutoriales</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Embajadores</a></li>
                        </ul>
                    </div>

                    {{-- Compañía --}}
                    <div>
                        <h5 class="text-white font-bold mb-4">Compañía</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Acerca de</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Patrocinadores</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Trabaja con nosotros</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Contacto</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Copyright --}}
                <div class="mt-10 pt-6 border-t border-cb-border text-center text-sm text-gray-500">
                    <p>© 2025 CodeBattle. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>