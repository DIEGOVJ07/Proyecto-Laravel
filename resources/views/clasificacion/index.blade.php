<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-chart-bar text-cb-green mr-2"></i>
            Clasificación Global
        </h2>
        <p class="text-gray-400 text-sm mt-1">Los mejores programadores competitivos del mundo</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Salón de la Fama (Top 3) --}}
            <section>
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-star text-yellow-400 mr-3"></i>
                    Salón de la Fama
                </h3>

                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($hallOfFame as $index => $entry)
                        <div class="bg-cb-card p-8 rounded-xl shadow-xl border-2 transition duration-300 hover:scale-105
                            @if($index == 0) border-yellow-400 bg-gradient-to-br from-yellow-900/20 to-cb-card
                            @elseif($index == 1) border-gray-400 bg-gradient-to-br from-gray-700/20 to-cb-card
                            @else border-orange-600 bg-gradient-to-br from-orange-900/20 to-cb-card
                            @endif
                        ">
                            {{-- Icono del puesto --}}
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-3">
                                    @if($index == 0) 🏆
                                    @elseif($index == 1) 👑
                                    @else ⚡
                                    @endif
                                </div>
                                <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center text-3xl font-bold text-white
                                    @if($index == 0) bg-gradient-to-br from-yellow-400 to-yellow-600
                                    @elseif($index == 1) bg-gradient-to-br from-gray-300 to-gray-500
                                    @else bg-gradient-to-br from-orange-400 to-orange-600
                                    @endif
                                ">
                                    {{ strtoupper(substr($entry->user->name, 0, 1)) }}
                                </div>
                            </div>

                            {{-- Información --}}
                            <h4 class="text-2xl font-bold text-white text-center mb-2">{{ $entry->user->name }}</h4>
                            <p class="text-center text-sm mb-6
                                @if($index == 0) text-yellow-400
                                @elseif($index == 1) text-gray-300
                                @else text-orange-400
                                @endif
                            ">
                                @if($index == 0) Campeón CodeBattle 2024
                                @elseif($index == 1) Mejor Algoritmo del Año
                                @else Racha de 50 Victorias
                                @endif
                            </p>

                            <div class="space-y-2 text-sm text-gray-400">
                                <div class="flex justify-between">
                                    <span>Puntos:</span>
                                    <span class="text-cb-green font-bold">{{ number_format($entry->total_points) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Concursos ganados:</span>
                                    <span class="text-white font-bold">{{ $entry->contests_won }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Problemas resueltos:</span>
                                    <span class="text-white font-bold">{{ $entry->problems_solved }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Tabla de clasificación (Desktop) --}}
            <section class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-cb-dark">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rango</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Puntos</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Concursos Ganados</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Problemas Resueltos</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tendencia</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cb-border">
                            @foreach($topUsers as $entry)
                                <tr class="hover:bg-cb-dark/50 transition">
                                    {{-- Rango --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-2xl">
                                            @if($entry->global_ranking == 1)
                                                <span class="text-yellow-400">👑</span>
                                            @elseif($entry->global_ranking == 2)
                                                <span class="text-gray-300">🥈</span>
                                            @elseif($entry->global_ranking == 3)
                                                <span class="text-orange-400">🥉</span>
                                            @else
                                                <span class="text-gray-400 text-base font-bold">#{{ $entry->global_ranking }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Usuario --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-lg flex items-center justify-center text-white font-bold">
                                                {{ strtoupper(substr($entry->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="text-white font-medium">{{ $entry->user->name }}</div>
                                                <div class="text-gray-400 text-xs">{{ $entry->country_code }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Puntos --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-cb-green font-bold text-lg">{{ number_format($entry->total_points) }}</span>
                                    </td>

                                    {{-- Concursos ganados --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-white font-medium flex items-center space-x-2">
                                            <i class="fas fa-trophy text-yellow-400"></i>
                                            <span>{{ $entry->contests_won }}</span>
                                        </span>
                                    </td>

                                    {{-- Problemas resueltos --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-white font-medium">{{ $entry->problems_solved }}</span>
                                    </td>

                                    {{-- Tendencia --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($entry->trend == 'up')
                                            <i class="fas fa-arrow-up text-green-400"></i>
                                        @elseif($entry->trend == 'down')
                                            <i class="fas fa-arrow-down text-red-400"></i>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Vista móvil (Cards) --}}
                <div class="md:hidden p-4 space-y-4">
                    @foreach($topUsers as $entry)
                        <div class="bg-cb-dark/50 rounded-xl p-4 border border-cb-border">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="text-2xl">
                                        @if($entry->global_ranking == 1) 👑
                                        @elseif($entry->global_ranking == 2) 🥈
                                        @elseif($entry->global_ranking == 3) 🥉
                                        @else <span class="text-gray-400 font-bold">#{{ $entry->global_ranking }}</span>
                                        @endif
                                    </div>
                                    <div class="w-12 h-12 bg-gradient-to-br from-cb-green to-green-600 rounded-lg flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($entry->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold">{{ $entry->user->name }}</h4>
                                        <p class="text-gray-400 text-xs">{{ $entry->country_code }}</p>
                                    </div>
                                </div>
                                <div>
                                    @if($entry->trend == 'up')
                                        <i class="fas fa-arrow-up text-green-400"></i>
                                    @elseif($entry->trend == 'down')
                                        <i class="fas fa-arrow-down text-red-400"></i>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2 text-center">
                                <div>
                                    <p class="text-cb-green font-bold">{{ number_format($entry->total_points) }}</p>
                                    <p class="text-gray-400 text-xs">Puntos</p>
                                </div>
                                <div>
                                    <p class="text-white font-bold">{{ $entry->contests_won }}</p>
                                    <p class="text-gray-400 text-xs">Ganados</p>
                                </div>
                                <div>
                                    <p class="text-white font-bold">{{ $entry->problems_solved }}</p>
                                    <p class="text-gray-400 text-xs">Resueltos</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Tu Posición --}}
            @if($userPosition)
                <section class="bg-gradient-to-r from-cb-green/10 to-cb-card border-2 border-cb-green rounded-xl p-6">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-1">Tu Posición</h3>
                                <p class="text-3xl font-extrabold text-cb-green">#{{ $userPosition->global_ranking }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-8 text-center">
                            <div>
                                <p class="text-3xl font-bold text-white">{{ number_format($userPosition->total_points) }}</p>
                                <p class="text-gray-400 text-sm">Puntos</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white">{{ $userPosition->contests_won }}</p>
                                <p class="text-gray-400 text-sm">Victorias</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white">{{ $userPosition->problems_solved }}</p>
                                <p class="text-gray-400 text-sm">Resueltos</p>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
</x-app-layout>