<x-app-web>
    <section class="bg-slate-950 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-3">
                    Sedes y Ubicaciones
                </h2>
                <p class="text-gray-400 text-lg">
                    Encuentra la sede más cercana para participar en persona
                </p>
            </div>

            <div
                class="bg-slate-900 border border-slate-800 rounded-2xl p-4 mb-16 h-80 relative flex items-center justify-center overflow-hidden group">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: linear-gradient(#334155 1px, transparent 1px), linear-gradient(90deg, #334155 1px, transparent 1px); background-size: 40px 40px;">
                </div>

                <div class="text-center relative z-10">
                    <div class="bg-cyan-500/10 p-4 rounded-full inline-block mb-4 border border-cyan-500/20">
                        <svg class="w-12 h-12 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Mapa Interactivo</h3>
                    <p class="text-gray-400 mb-6">Visualiza todas nuestras sedes en México</p>
                    <button
                        class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold py-2.5 px-6 rounded-lg transition-colors flex items-center gap-2 mx-auto">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7" />
                        </svg>
                        Ver en Google Maps
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                @foreach ($sedes as $sede)
                    <div
                        class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden hover:border-cyan-500/30 transition-all duration-300">
                        <div class="p-8">
                            <div class="flex items-start gap-4 mb-6">
                                <div
                                    class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0
                                @if ($sede['type'] == 'building') bg-blue-500/10 border border-blue-500/20 text-blue-400 @endif
                                @if ($sede['type'] == 'convention') bg-slate-700/50 border border-slate-600 text-gray-300 @endif
                                @if ($sede['type'] == 'arena') bg-pink-500/10 border border-pink-500/20 text-pink-400 @endif
                            ">
                                    @if ($sede['type'] == 'building')
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    @elseif($sede['type'] == 'convention')
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                        </svg>
                                    @elseif($sede['type'] == 'arena')
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </div>

                                <div>
                                    <h3 class="text-xl font-bold text-white mb-1">{{ $sede['name'] }}</h3>
                                    <div class="flex items-center text-sm text-cyan-400">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $sede['address'] }}
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div
                                    class="flex justify-between items-center bg-slate-950/50 p-3 rounded-lg border border-slate-800">
                                    <div class="flex items-center text-gray-400 gap-2 text-sm">
                                        <svg class="w-5 h-5 text-cyan-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Capacidad
                                    </div>
                                    <span class="font-bold text-white">{{ $sede['capacity'] }} personas</span>
                                </div>

                                <div
                                    class="flex justify-between items-center bg-slate-950/50 p-3 rounded-lg border border-slate-800">
                                    <div class="flex items-center text-gray-400 gap-2 text-sm">
                                        <svg class="w-5 h-5 text-cyan-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Próximos eventos
                                    </div>
                                    <span class="text-emerald-400 font-medium text-sm">{{ $sede['next_events'] }}
                                        concursos</span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <p
                                    class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-3 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    Características:
                                </p>
                                <div class="grid grid-cols-2 gap-y-3 gap-x-2">
                                    @foreach ($sede['features'] as $feature)
                                        <div class="flex items-center text-sm text-gray-300 gap-2">
                                            @if ($feature['icon'] == 'wifi')
                                                <svg class="w-4 h-4 text-cyan-500" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                                                </svg>
                                            @endif
                                            @if ($feature['icon'] == 'parking')
                                                <svg class="w-4 h-4 text-cyan-500" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.637-.087 3.82-.254" />
                                                    <path d="M5 10l7-2 7 2" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" />
                                                </svg> 🚗
                                            @endif
                                            @if ($feature['icon'] == 'coffee' || $feature['icon'] == 'snack')
                                                ☕
                                            @endif
                                            @if ($feature['icon'] == 'ac')
                                                ❄️
                                            @endif
                                            @if ($feature['icon'] == 'rest')
                                                🛋️
                                            @endif
                                            @if ($feature['icon'] == 'projector')
                                                📽️
                                            @endif
                                            @if ($feature['icon'] == 'streaming')
                                                📡
                                            @endif
                                            @if ($feature['icon'] == 'gaming')
                                                🎮
                                            @endif
                                            @if ($feature['icon'] == 'work')
                                                💼
                                            @endif

                                            <span>{{ $feature['text'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-950/30 p-4 border-t border-slate-800 grid grid-cols-2 gap-4">
                            <button
                                class="w-full py-2 rounded-lg border border-cyan-500/30 text-cyan-400 hover:bg-cyan-500/10 text-sm font-medium transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Ver Ubicación
                            </button>
                            <button
                                class="w-full py-2 rounded-lg border border-slate-700 text-gray-300 hover:border-white hover:text-white text-sm font-medium transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Ver Eventos
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-900/50 p-6 rounded-xl border border-slate-800">
                    <svg class="w-8 h-8 text-cyan-400 mb-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                    </svg>
                    <h4 class="text-xl font-bold text-white mb-2">Conexión Garantizada</h4>
                    <p class="text-gray-400 text-sm">Todas nuestras sedes cuentan con internet de alta velocidad y
                        conexión estable para competir sin interrupciones.</p>
                </div>
                <div class="bg-slate-900/50 p-6 rounded-xl border border-slate-800">
                    <svg class="w-8 h-8 text-emerald-400 mb-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                    <h4 class="text-xl font-bold text-white mb-2">Fácil Acceso</h4>
                    <p class="text-gray-400 text-sm">Estacionamiento disponible y ubicaciones estratégicas con acceso a
                        transporte público.</p>
                </div>
                <div class="bg-slate-900/50 p-6 rounded-xl border border-slate-800">
                    <svg class="w-8 h-8 text-blue-400 mb-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h4 class="text-xl font-bold text-white mb-2">Instalaciones Premium</h4>
                    <p class="text-gray-400 text-sm">Espacios cómodos y modernos diseñados específicamente para eventos
                        de programación competitiva.</p>
                </div>
            </div>

            <div
                class="mt-16 relative bg-slate-900/80 backdrop-blur-sm border border-slate-800 rounded-2xl p-8 md:p-12 text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                    ¿Quieres organizar un evento en tu ciudad?
                </h2>
                <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
                    Contáctanos para conocer más sobre cómo convertir tu espacio en una sede oficial de CodeBattle
                </p>
                <button
                    class="bg-cyan-500 hover:bg-cyan-400 text-slate-900 font-bold py-3 px-8 rounded-lg transition-all duration-300 shadow-lg shadow-cyan-500/25">
                    Contáctanos
                </button>
            </div>

        </div>
    </section>
</x-app-web>
