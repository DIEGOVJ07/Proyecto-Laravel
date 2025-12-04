<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-map-marker-alt text-cb-green mr-2"></i>
            Sedes y Ubicaciones
        </h2>
        <p class="text-gray-400 text-sm mt-1">Encuentra la sede más cercana para participar en persona</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Header con estadísticas --}}
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Total de Sedes</p>
                            <p class="text-3xl font-bold text-white">{{ count($venues) }}</p>
                        </div>
                        <div class="w-14 h-14 bg-cb-green/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-2xl text-cb-green"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Capacidad Total</p>
                            <p class="text-3xl font-bold text-white">{{ array_sum(array_column($venues, 'capacity')) }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-2xl text-blue-400"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Eventos Próximos</p>
                            <p class="text-3xl font-bold text-white">{{ array_sum(array_column($venues, 'upcoming_events')) }}</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-2xl text-purple-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Beneficios de las sedes --}}
            <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-white mb-6 text-center">¿Por qué asistir presencialmente?</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-wifi text-3xl text-cb-green"></i>
                        </div>
                        <h4 class="text-white font-bold mb-2">Conexión Garantizada</h4>
                        <p class="text-gray-400 text-sm">Internet de alta velocidad y conexión estable sin interrupciones</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-car text-3xl text-cb-green"></i>
                        </div>
                        <h4 class="text-white font-bold mb-2">Fácil Acceso</h4>
                        <p class="text-gray-400 text-sm">Ubicaciones estratégicas con estacionamiento y transporte público</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-3xl text-cb-green"></i>
                        </div>
                        <h4 class="text-white font-bold mb-2">Instalaciones Premium</h4>
                        <p class="text-gray-400 text-sm">Espacios cómodos y modernos diseñados para eventos de programación</p>
                    </div>
                </div>
            </div>

            {{-- Grid de sedes --}}
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($venues as $venue)
                    <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition duration-300 overflow-hidden group">
                        {{-- Header con icono --}}
                        <div class="bg-gradient-to-r from-cb-green/20 to-cb-card p-6 border-b border-cb-border">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="text-5xl">{{ $venue['image'] }}</div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white">{{ $venue['name'] }}</h3>
                                        <p class="text-cb-green font-semibold">{{ $venue['acronym'] }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-cb-green/20 text-cb-green border border-cb-green rounded-full text-xs font-bold">
                                    {{ $venue['upcoming_events'] }} eventos
                                </span>
                            </div>
                        </div>

                        {{-- Información --}}
                        <div class="p-6 space-y-4">
                            {{-- Dirección --}}
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-cb-green mt-1"></i>
                                <div>
                                    <p class="text-white font-medium">{{ $venue['address'] }}</p>
                                    <p class="text-gray-400 text-sm">{{ $venue['city'] }}</p>
                                </div>
                            </div>

                            {{-- Capacidad --}}
                            <div class="flex items-center justify-between p-3 bg-cb-dark/50 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-users text-blue-400"></i>
                                    <span class="text-gray-400 text-sm">Capacidad</span>
                                </div>
                                <span class="text-white font-bold">{{ $venue['capacity'] }} personas</span>
                            </div>

                            {{-- Características --}}
                            <div>
                                <h4 class="text-white font-semibold mb-3 flex items-center">
                                    <i class="fas fa-check-circle text-cb-green mr-2"></i>
                                    Características
                                </h4>
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach(array_slice($venue['features'], 0, 4) as $feature)
                                        <div class="flex items-center space-x-2 text-sm">
                                            <i class="fas fa-check text-cb-green text-xs"></i>
                                            <span class="text-gray-400">{{ $feature }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($venue['features']) > 4)
                                    <p class="text-cb-green text-xs mt-2">+{{ count($venue['features']) - 4 }} más</p>
                                @endif
                            </div>

                            {{-- Próximos eventos --}}
                            <div>
                                <h4 class="text-white font-semibold mb-3 flex items-center">
                                    <i class="fas fa-calendar text-cb-green mr-2"></i>
                                    Próximos Eventos
                                </h4>
                                <div class="space-y-2">
                                    @foreach(array_slice($venue['events'], 0, 2) as $event)
                                        <div class="flex items-center justify-between p-2 bg-cb-dark/30 rounded">
                                            <div>
                                                <p class="text-white text-sm font-medium">{{ $event['name'] }}</p>
                                                <p class="text-gray-400 text-xs">{{ $event['date'] }} • {{ $event['participants'] }} participantes</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Botones de acción --}}
                            <div class="grid grid-cols-2 gap-3 pt-4">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $venue['lat'] }},{{ $venue['lng'] }}" 
                                   target="_blank"
                                   class="flex items-center justify-center space-x-2 bg-cb-green/10 hover:bg-cb-green/20 text-cb-green font-semibold py-3 px-4 rounded-lg transition group">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ver Ubicación</span>
                                </a>

                                <button onclick="showEvents{{ $venue['id'] }}.showModal()" 
                                        class="flex items-center justify-center space-x-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 font-semibold py-3 px-4 rounded-lg transition">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Ver Eventos</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Modal de eventos --}}
                    <dialog id="showEvents{{ $venue['id'] }}" class="rounded-xl bg-cb-card border border-cb-border p-0 backdrop:bg-black/70">
                        <div class="w-full max-w-2xl">
                            <div class="bg-gradient-to-r from-cb-green/20 to-cb-card p-6 border-b border-cb-border">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-2xl font-bold text-white">Eventos en {{ $venue['acronym'] }}</h3>
                                    <button onclick="showEvents{{ $venue['id'] }}.close()" class="text-gray-400 hover:text-white">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                                @foreach($venue['events'] as $event)
                                    <div class="bg-cb-dark/50 p-4 rounded-lg border border-cb-border hover:border-cb-green/50 transition">
                                        <div class="flex items-start justify-between mb-2">
                                            <h4 class="text-white font-bold">{{ $event['name'] }}</h4>
                                            <span class="px-3 py-1 bg-cb-green/20 text-cb-green border border-cb-green rounded-full text-xs font-semibold">
                                                {{ $event['date'] }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-4 text-sm text-gray-400">
                                            <div class="flex items-center space-x-2">
                                                <i class="fas fa-users text-cb-green"></i>
                                                <span>{{ $event['participants'] }} participantes</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <i class="fas fa-map-marker-alt text-cb-green"></i>
                                                <span>{{ $venue['acronym'] }}</span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            @auth
                                                <button class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition">
                                                    <i class="fas fa-ticket-alt mr-2"></i>
                                                    Registrarse
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}" class="block w-full text-center bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-2 px-4 rounded-lg transition">
                                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                                    Inicia Sesión para Registrarte
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </dialog>
                @endforeach
            </div>

            {{-- CTA final --}}
            <div class="bg-cb-card border border-cb-border rounded-xl p-8 text-center">
                <h3 class="text-2xl font-bold text-white mb-4">¿Quieres organizar un evento en tu ciudad?</h3>
                <p class="text-gray-400 mb-6 max-w-2xl mx-auto">
                    Contáctanos para conocer más sobre cómo convertir tu espacio en una sede oficial de CodeBattle
                </p>
                <a href="#" class="inline-flex items-center space-x-2 bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                    <i class="fas fa-envelope"></i>
                    <span>Contáctanos</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>