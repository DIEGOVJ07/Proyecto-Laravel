<x-app-layout>
    {{-- Script del Contador --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const targetTimeElement = document.getElementById('countdown-timer');
            if (!targetTimeElement) return;

            @if($nextEvent && $nextEvent->start_date)
            const targetTime = new Date('{{ $nextEvent->start_date->format('Y-m-d') }}').getTime();
            const timer = targetTimeElement;
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

                const formatTime = (time) => String(time).padStart(2, '0');

                timer.innerHTML = `
                    <div class="flex flex-col items-center">
                        <span class="text-4xl font-bold">${formatTime(days)}</span>
                        <span class="text-sm">Días</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-4xl font-bold">${formatTime(hours)}</span>
                        <span class="text-sm">Horas</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-4xl font-bold">${formatTime(minutes)}</span>
                        <span class="text-sm">Min</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-4xl font-bold">${formatTime(seconds)}</span>
                        <span class="text-sm">Seg</span>
                    </div>
                `;
            }

            updateCountdown();
            @endif
        });
    </script>
    @endpush

    <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

                {{-- Hero Section --}}
                <section class="text-center pt-10 pb-16">
                    <p class="text-cb-green font-semibold mb-4 text-sm uppercase tracking-wider">
                        # Plataforma de Programación Competitiva
                    </p>
                    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight text-white">
                        Codifica el futuro. <br>
                        <span class="text-cb-green">Gana hoy.</span>
                    </h1>
                    <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-8">
                        Únete a la comunidad de desarrolladores más competitiva. Resuelve desafíos, compite en tiempo real y lleva tus habilidades al siguiente nivel.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @auth
                            <a href="{{ route('profile.index') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                                <i class="fas fa-user mr-2"></i>
                                Ver Mi Perfil →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Comenzar Ahora →
                            </a>
                        @endauth
                        <a href="#concursos" class="border-2 border-cb-green text-white hover:bg-cb-green hover:text-cb-dark py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                            Ver Concursos
                        </a>
                    </div>
                </section>

                {{-- Próximo Evento --}}
                <section id="evento-destacado">
                    <h2 class="text-center text-2xl font-bold mb-2 text-white">
                        Próximo Evento Destacado
                    </h2>
                    <p class="text-center text-sm text-gray-400 mb-8">No te pierdas el concurso más esperado del mes</p>
                    
                    @if($nextEvent)
                    <div class="bg-cb-card border border-cb-green/50 shadow-2xl rounded-2xl p-8 max-w-4xl mx-auto" style="box-shadow: 0 0 30px rgba(16, 185, 129, 0.2);">
                        <div class="grid md:grid-cols-3 gap-8 items-center">
                            <div class="md:col-span-2 space-y-4">
                                <span class="inline-flex items-center space-x-2 text-sm font-semibold text-cb-green">
                                    <i class="fas fa-trophy"></i>
                                    <span>Premio: ${{ number_format($nextEvent->prize) }}</span>
                                </span>
                                <h3 class="text-3xl md:text-4xl font-extrabold text-white">
                                    {{ $nextEvent->name }}
                                </h3>
                                <p class="text-gray-300">
                                    El torneo más grande del año está por comenzar. Compite contra los mejores programadores y demuestra tus habilidades en algoritmos avanzados y estructuras de datos.
                                </p>
                                <ul class="text-gray-300 text-sm space-y-2 pt-2">
                                    <li class="flex items-center space-x-2">
                                        <i class="far fa-calendar-alt text-cb-green"></i>
                                        <span>{{ $nextEvent->start_date->format('d/m/Y') }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                        <i class="far fa-clock text-cb-green"></i>
                                        <span>Duración: {{ $nextEvent->duration }}</span>
                                    </li>
                                    <li class="flex items-center space-x-2">
                                        <i class="fas fa-users text-cb-green"></i>
                                        <span>{{ number_format($nextEvent->participants) }} participantes registrados</span>
                                    </li>
                                </ul>
                                @auth
                                    <a href="#" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 inline-flex items-center space-x-2 mt-4">
                                        <span>Registrarse Ahora</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 inline-flex items-center space-x-2 mt-4">
                                        <span>Inicia Sesión para Registrarte</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @endauth
                            </div>

                            <div class="flex flex-col items-center space-y-4">
                                <p class="text-sm text-gray-300 font-medium">Comienza en</p>
                                <div id="countdown-timer" class="grid grid-cols-4 gap-4 text-center text-white"></div>
                                <p class="text-xs text-cb-green flex items-center space-x-2 pt-4">
                                    <i class="fas fa-bolt"></i>
                                    <span>Registro anticipado disponible</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="bg-cb-card border border-cb-border rounded-2xl p-8 max-w-4xl mx-auto text-center">
                        <i class="fas fa-calendar-times text-6xl text-gray-600 mb-4"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">No hay eventos próximos</h3>
                        <p class="text-gray-400">Estamos trabajando en nuevos concursos emocionantes. ¡Vuelve pronto!</p>
                    </div>
                    @endif
                </section>

                {{-- Concursos --}}
                <section id="concursos">
                    <h2 class="text-3xl font-bold mb-2 text-white">Concursos Recientes</h2>
                    <p class="text-gray-300 mb-8">Encuentra el desafío perfecto para ti</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($contests as $contest)
                            <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition duration-300 transform hover:scale-[1.02]">
                                <div class="flex justify-between items-center mb-4">
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

                                <h4 class="text-xl font-bold mb-2 text-white">{{ $contest->name }}</h4>
                                <p class="text-gray-300 text-sm mb-4">{{ $contest->description }}</p>

                                <div class="text-sm text-gray-300 space-y-2 border-t border-b border-cb-border py-3 my-3">
                                    <p class="flex items-center space-x-2">
                                        <i class="far fa-clock text-cb-green"></i>
                                        <span>{{ $contest->duration }}</span>
                                    </p>
                                    <p class="flex items-center space-x-2">
                                        <i class="fas fa-user-friends text-cb-green"></i>
                                        <span>{{ number_format($contest->participants) }} participantes</span>
                                    </p>
                                    <p class="flex items-center space-x-2 text-cb-green font-bold">
                                        <i class="fas fa-award"></i>
                                        <span>Premio: ${{ number_format($contest->prize) }}</span>
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-2 mb-4">
          {{-- CÓDIGO CORREGIDO --}}
{{-- Nota el "?? []" después de la variable --}}
@foreach($contest->tags ?? [] as $tag)
    <span class="badge">{{ $tag }}</span>
@endforeach
                                </div>

                                @auth
                                    <a href="{{ route('concursos.show', $contest->id) }}" class="mt-4 block text-center bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition duration-300">
                                        Ver Detalles →
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="mt-4 block text-center bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition duration-300">
                                        Inicia Sesión para Ver →
                                    </a>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Características --}}
                <section class="py-16">
                    <h2 class="text-3xl font-bold text-center mb-12 text-white">¿Por qué CodeBattle?</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-trophy text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Competencia Real</h3>
                            <p class="text-gray-300">Enfrenta a programadores de todo el mundo en desafíos en tiempo real</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Mejora Continua</h3>
                            <p class="text-gray-300">Rastrea tu progreso y mejora tus habilidades con cada desafío</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Comunidad Activa</h3>
                            <p class="text-gray-300">Únete a miles de desarrolladores apasionados por la programación</p>
                        </div>
                    </div>
                </section>

            </div>
        </main>

        {{-- Footer --}}
        <footer class="mt-20 border-t border-cb-border bg-cb-card pt-10 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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
                            <a href="#" class="hover:text-cb-green transition"><i class="fab fa-facebook text-xl"></i></a>
                            <a href="#" class="hover:text-cb-green transition"><i class="fab fa-instagram text-xl"></i></a>
                            <a href="#" class="hover:text-cb-green transition"><i class="fab fa-github text-xl"></i></a>
                        </div>
                    </div>

                    <div>
                        <h5 class="text-white font-bold mb-4">Plataforma</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Cómo funciona</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Reglas y términos</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Preguntas frecuentes</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Documentación</a></li>
                        </ul>
                    </div>

                    <div>
                        <h5 class="text-white font-bold mb-4">Comunidad</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Discord</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Foro</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Tutoriales</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Embajadores</a></li>
                        </ul>
                    </div>

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

                <div class="mt-10 pt-6 border-t border-cb-border text-center text-sm text-gray-500">
                    <p>© 2025 CodeBattle. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>