<x-app-web>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Encabezado Centrado -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-white mb-2">Clasificación Global</h1>
            <p class="text-gray-400 text-lg">Los mejores programadores competitivos del mundo</p>
        </div>

        <!-- Tabla de Clasificación -->
        <div class="bg-slate-900 rounded-xl border border-slate-700 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800 border-b border-slate-700 text-gray-300 text-sm font-semibold uppercase tracking-wider">
                            <th class="px-6 py-5">Rango</th>
                            <th class="px-6 py-5">Usuario</th>
                            <th class="px-6 py-5 text-right">Puntos</th>
                            <th class="px-6 py-5 text-center">Concursos Ganados</th>
                            <th class="px-6 py-5 text-center">Problemas Resueltos</th>
                            <th class="px-6 py-5 text-center">Tendencia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @foreach($leaders as $leader)
                        <tr class="hover:bg-slate-800/50 transition duration-150 group">
                            
                            <!-- Columna: Rango (Con Iconos para Top 3) -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($leader['rank'] == 1)
                                        <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3 6 6 1-4.5 4.5L18 22l-6-3-6 3 1.5-8.5L3 9l6-1z"/></svg>
                                        <span class="ml-2 text-yellow-500 font-bold text-lg">1</span>
                                    @elseif($leader['rank'] == 2)
                                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3 6 6 1-4.5 4.5L18 22l-6-3-6 3 1.5-8.5L3 9l6-1z"/></svg>
                                        <span class="ml-2 text-gray-300 font-bold text-lg">2</span>
                                    @elseif($leader['rank'] == 3)
                                        <svg class="w-6 h-6 text-orange-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3 6 6 1-4.5 4.5L18 22l-6-3-6 3 1.5-8.5L3 9l6-1z"/></svg>
                                        <span class="ml-2 text-orange-700 font-bold text-lg">3</span>
                                    @else
                                        <span class="text-gray-500 font-medium pl-2">#{{ $leader['rank'] }}</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Columna: Usuario -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full {{ $leader['color'] }} flex items-center justify-center text-white font-bold">
                                        {{ $leader['initial'] }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-white">{{ $leader['name'] }}</div>
                                        <div class="text-xs text-gray-500">{{ $leader['country'] }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Columna: Puntos -->
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <span class="text-cyan-400 font-bold text-base">{{ $leader['points'] }}</span>
                            </td>

                            <!-- Columna: Concursos Ganados -->
                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center text-gray-300">
                                    <svg class="w-4 h-4 mr-1.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                    {{ $leader['wins'] }}
                                </div>
                            </td>

                            <!-- Columna: Problemas Resueltos -->
                            <td class="px-6 py-5 whitespace-nowrap text-center text-gray-300 font-medium">
                                {{ $leader['solved'] }}
                            </td>

                            <!-- Columna: Tendencia -->
                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                @if($leader['trend'] === 'up')
                                    <svg class="w-5 h-5 text-emerald-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                @elseif($leader['trend'] === 'down')
                                    <svg class="w-5 h-5 text-red-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                    </svg>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-web>
