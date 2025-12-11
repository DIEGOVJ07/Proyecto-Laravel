<x-app-layout>
    {{-- FONDO PRINCIPAL OSCURO (HEX #0f111a) --}}
    <div class="bg-[#0f111a] min-h-screen py-10 font-sans text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. ENCABEZADO --}}
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="space-y-3">
                    {{-- Badges de Estado y Dificultad --}}
                    <div class="flex items-center gap-2">
                        @if($event->status === 'Activo')
                            <span class="px-3 py-1 rounded-full border border-[#10b981] bg-[#10b981] text-white text-[11px] font-bold uppercase tracking-wider flex items-center gap-1.5 shadow-[0_0_10px_rgba(16,185,129,0.4)]">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Activo
                            </span>
                        @elseif($event->status === 'Finalizado')
                            <span class="px-3 py-1 rounded-full border border-gray-600 bg-gray-700/30 text-gray-400 text-[11px] font-bold uppercase tracking-wider">
                                Finalizado
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full border border-blue-500 bg-blue-500/10 text-blue-400 text-[11px] font-bold uppercase tracking-wider">
                                Próximamente
                            </span>
                        @endif

                        {{-- Badge Dificultad --}}
                        @if($event->difficulty === 'Difícil')
                            <span class="px-3 py-1 rounded-full border border-[#ef4444] bg-[#ef4444]/10 text-[#ef4444] text-[11px] font-bold uppercase tracking-wider">
                                Difícil
                            </span>
                        @elseif($event->difficulty === 'Medio')
                            <span class="px-3 py-1 rounded-full border border-[#f59e0b] bg-[#f59e0b]/10 text-[#f59e0b] text-[11px] font-bold uppercase tracking-wider">
                                Medio
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full border border-[#10b981] bg-[#10b981]/10 text-[#10b981] text-[11px] font-bold uppercase tracking-wider">
                                Fácil
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">{{ $event->name }}</h1>
                </div>

                <a href="{{ route('clasificacion.index') }}" class="px-4 py-2 rounded-lg border border-[#2c3240] bg-[#151a25] text-gray-400 text-sm font-medium hover:text-white hover:border-gray-500 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- COLUMNA IZQUIERDA (2/3) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- TARJETA DE DESCRIPCIÓN --}}
                    <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-8 shadow-lg">
                        <h3 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                            <i class="fas fa-align-left text-[#10b981]"></i> Descripción
                        </h3>
                        
                        <p class="text-gray-400 text-sm leading-relaxed mb-8">
                            {{ $event->description }}
                        </p>

                        <div class="border-t border-[#2c3240] mb-6"></div>

                        {{-- Stats Row --}}
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">DURACIÓN</p>
                                <div class="flex items-center gap-2 text-white font-semibold">
                                    <i class="far fa-clock text-[#10b981]"></i> {{ $event->duration }}
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">PARTICIPANTES</p>
                                <div class="flex items-center gap-2 text-white font-semibold">
                                    <i class="fas fa-users text-[#10b981]"></i> {{ $event->participants }}
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">PREMIO</p>
                                <div class="flex items-center gap-2 text-[#10b981] font-bold text-lg">
                                    <i class="fas fa-trophy"></i> ${{ number_format($event->prize) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- GRID INFERIOR (Reglas y Stack) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Reglas --}}
                        <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-6">
                            <h4 class="text-white font-bold mb-3 text-sm uppercase flex items-center gap-2">
                                <i class="fas fa-gavel text-gray-400"></i> REGLAS
                            </h4>
                            <p class="text-gray-400 text-xs leading-relaxed">
                                {{ $event->rules ?? 'Debes resolver al menos 3 de 5 problemas. No se permite el uso de IA. El código debe ser original.' }}
                            </p>
                        </div>

                        {{-- Stack --}}
                        <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-6">
                            <h4 class="text-white font-bold mb-3 text-sm uppercase flex items-center gap-2">
                                <i class="fas fa-code text-gray-400"></i> STACK
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @if(is_array($event->languages))
                                    @foreach($event->languages as $lang)
                                        <span class="px-3 py-1.5 border border-[#2c3240] bg-[#0f111a] rounded text-xs text-gray-300 font-mono">
                                            {{ $lang }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 text-xs">Cualquiera</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA (1/3) - TARJETA DE ACCIÓN --}}
                <div class="lg:col-span-1">
                    <div class="bg-[#151a25] border border-[#2c3240] rounded-xl p-8 sticky top-8 h-fit shadow-xl">
                        
                        {{-- IF PRINCIPAL: ESTADO ACTIVO O PRÓXIMAMENTE --}}
                        @if($event->status === 'Activo' || $event->status === 'Próximamente')
                            
                            @if($isRegistered)
                                {{-- VISTA: YA INSCRITO --}}
                                <div class="text-center py-4">
                                    <div class="w-20 h-20 rounded-full border-4 border-[#10b981] flex items-center justify-center mx-auto mb-6 bg-[#10b981]/10 shadow-[0_0_20px_rgba(16,185,129,0.2)]">
                                        <i class="fas fa-check text-[#10b981] text-4xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">¡Inscrito!</h3>
                                    <p class="text-gray-400 text-sm mb-8">Estás listo para competir.</p>
                                    
                                    <div class="bg-[#0f111a] border border-[#2c3240] rounded-lg p-4 text-left mb-6">
                                        <div class="flex justify-between items-center mb-3 pb-3 border-b border-[#2c3240]">
                                            <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">TU EQUIPO</span>
                                            <span class="text-white font-bold text-sm text-right truncate w-24">{{ $registration->team_name }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">CÓDIGO</span>
                                            <span class="text-[#f59e0b] font-mono font-bold tracking-widest">{{ $registration->team_code }}</span>
                                        </div>
                                    </div>

                                    {{-- SECCIÓN DE ARCHIVOS Y GITHUB --}}
                                    <div class="bg-[#0f111a] border border-[#2c3240] rounded-lg p-5 mb-6">
                                        <h4 class="text-white font-bold mb-4 text-sm uppercase flex items-center gap-2">
                                            <i class="fas fa-upload text-[#10b981]"></i> Proyecto
                                        </h4>

                                        {{-- Upload de Archivo --}}
                                        <form action="{{ route('concursos.upload-file', $event->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">Archivo (Max: 50MB)</label>
                                            <input type="file" name="project_file" class="w-full bg-[#151a25] border border-[#2c3240] rounded-lg text-gray-300 text-xs px-3 py-2 focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-[#10b981]/20 file:text-[#10b981] hover:file:bg-[#10b981]/30" accept="*" required>
                                            
                                            @if($registration->project_file)
                                                <div class="mt-2 flex items-center justify-between text-xs">
                                                    <span class="text-gray-400">
                                                        <i class="fas fa-file-alt text-[#10b981]"></i> 
                                                        {{ basename($registration->project_file) }}
                                                    </span>
                                                    <span class="text-gray-500">{{ $registration->file_uploaded_at?->format('d/m/Y H:i') }}</span>
                                                </div>
                                            @endif

                                            <button type="submit" class="w-full mt-3 bg-[#10b981]/20 hover:bg-[#10b981]/30 border border-[#10b981] text-[#10b981] font-bold py-2 rounded-lg transition text-xs uppercase">
                                                <i class="fas fa-cloud-upload-alt mr-1"></i> Subir Archivo
                                            </button>
                                        </form>

                                        {{-- GitHub Link --}}
                                        <form action="{{ route('concursos.update-github', $event->id) }}" method="POST" class="border-t border-[#2c3240] pt-4">
                                            @csrf
                                            <label class="text-[10px] text-gray-500 uppercase font-bold mb-1.5 block tracking-wider">GitHub Repository</label>
                                            <input type="url" name="github_link" value="{{ $registration->github_link }}" class="w-full bg-[#151a25] border border-[#2c3240] rounded-lg text-white text-xs px-3 py-2 focus:border-[#10b981] focus:ring-1 focus:ring-[#10b981] outline-none placeholder-gray-600 transition" placeholder="https://github.com/usuario/repo" required>
                                            
                                            @if($registration->github_link)
                                                <a href="{{ $registration->github_link }}" target="_blank" class="mt-2 inline-flex items-center text-xs text-[#10b981] hover:text-[#059669]">
                                                    <i class="fab fa-github mr-1"></i> Ver repositorio
                                                </a>
                                            @endif

                                            <button type="submit" class="w-full mt-3 bg-[#10b981]/20 hover:bg-[#10b981]/30 border border-[#10b981] text-[#10b981] font-bold py-2 rounded-lg transition text-xs uppercase">
                                                <i class="fas fa-save mr-1"></i> Guardar GitHub
                                            </button>
                                        </form>
                                    </div>

                                    <form action="{{ route('concursos.cancel', $event->id) }}" method="POST" onsubmit="return confirm('¿Seguro?');">
                                        @csrf @method('DELETE')
                                        <button class="text-[#ef4444] hover:text-red-400 text-xs underline transition font-medium">
                                            Cancelar registro
                                        </button>
                                    </form>
                                </div>

                            @else
                                {{-- VISTA: FORMULARIO DE REGISTRO MEJORADO --}}
                                <div class="text-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-[#10b981]/30">
                                        <i class="fas fa-user-plus text-white text-2xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-1">Únete al Desafío</h3>
                                    <p class="text-xs text-gray-400">Crea tu equipo o únete a uno existente</p>
                                </div>

                                {{-- Botón para ver equipos públicos --}}
                                <a href="{{ route('equipos.public', $event->id) }}" class="block mb-6 bg-gradient-to-r from-purple-500/20 to-pink-500/20 hover:from-purple-500/30 hover:to-pink-500/30 border border-purple-500/50 text-purple-300 font-bold py-3 px-4 rounded-xl transition-all duration-300 text-sm text-center group shadow-md hover:shadow-purple-500/20">
                                    <i class="fas fa-users mr-2 group-hover:scale-110 transition-transform inline-block"></i> 
                                    <span>Ver Equipos Públicos Disponibles</span>
                                    <i class="fas fa-arrow-right ml-2 text-xs opacity-60 group-hover:translate-x-1 transition-transform inline-block"></i>
                                </a>

                                <div class="relative mb-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-[#2c3240]"></div>
                                    </div>
                                    <div class="relative flex justify-center text-xs uppercase">
                                        <span class="bg-[#151a25] px-3 text-gray-500 font-bold">O crea tu equipo</span>
                                    </div>
                                </div>

                                <form action="{{ route('concursos.register', $event->id) }}" method="POST" class="space-y-5">
                                    @csrf
                                    
                                    {{-- Nombre del Equipo --}}
                                    <div class="relative">
                                        <label class="text-[10px] text-gray-400 uppercase font-bold mb-2 block tracking-wider flex items-center gap-2">
                                            <i class="fas fa-shield-alt text-[#10b981]"></i>
                                            Nombre del Equipo
                                        </label>
                                        <input type="text" name="team_name" class="w-full bg-[#0f111a] border-2 border-[#2c3240] rounded-xl text-white text-sm px-4 py-3.5 focus:border-[#10b981] focus:ring-2 focus:ring-[#10b981]/20 outline-none placeholder-gray-600 transition-all" placeholder="Ej: CodeWarriors" required>
                                    </div>
                                    
                                    {{-- Número de Miembros --}}
                                    <div class="relative">
                                        <label class="text-[10px] text-gray-400 uppercase font-bold mb-2 block tracking-wider flex items-center gap-2">
                                            <i class="fas fa-user-friends text-[#10b981]"></i>
                                            Tamaño del Equipo
                                        </label>
                                        <div class="flex items-center gap-3 bg-[#0f111a] border-2 border-[#2c3240] rounded-xl px-4 py-3 focus-within:border-[#10b981] focus-within:ring-2 focus-within:ring-[#10b981]/20 transition-all">
                                            <input type="number" name="max_members" value="1" min="{{ $event->min_team_members }}" max="{{ $event->max_team_members }}" class="flex-1 bg-transparent text-white text-sm outline-none">
                                            <span class="text-xs text-gray-500 font-medium">/ {{ $event->max_team_members }} máx</span>
                                        </div>
                                    </div>

                                    {{-- Equipo Público --}}
                                    <div class="bg-[#0f111a] border border-[#2c3240] rounded-xl p-4">
                                        <label class="flex items-start gap-3 cursor-pointer group">
                                            <input type="checkbox" name="is_public" id="is_public" class="mt-1 rounded-md bg-[#151a25] border-[#2c3240] text-[#10b981] focus:ring-2 focus:ring-[#10b981]/30 w-5 h-5 transition">
                                            <div class="flex-1">
                                                <span class="text-sm font-bold text-white group-hover:text-[#10b981] transition">Equipo Público</span>
                                                <p class="text-xs text-gray-400 mt-1">Otros usuarios podrán encontrar y unirse a tu equipo</p>
                                            </div>
                                        </label>
                                    </div>

                                    {{-- Botón de Registro --}}
                                    <button type="submit" class="w-full bg-gradient-to-r from-[#10b981] to-[#059669] hover:from-[#059669] hover:to-[#047857] text-white font-bold py-4 rounded-xl transition-all duration-300 shadow-lg shadow-[#10b981]/30 hover:shadow-[#10b981]/50 text-sm uppercase tracking-wide group">
                                        <span class="flex items-center justify-center gap-2">
                                            <i class="fas fa-rocket group-hover:translate-y-[-2px] transition-transform"></i>
                                            Crear Equipo e Inscribirse
                                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                        </span>
                                    </button>
                                </form>
                            @endif

                        @else
                            {{-- ELSE PRINCIPAL: ESTADO FINALIZADO --}}
                            <div class="py-8 text-center">
                                <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto text-4xl mb-6 text-gray-600 border-2 border-gray-700">
                                    <i class="fas fa-flag-checkered"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">Finalizado</h3>
                                <p class="text-gray-400 text-sm mb-6">El evento ha concluido.</p>
                                
                                {{-- Botón para ver Ranking --}}
                                <a href="{{ route('clasificacion.show', $event->id) }}" class="w-full block py-3 bg-[#2c3240] hover:bg-gray-700 text-white rounded-lg text-sm font-bold transition text-center border border-gray-600 mb-3">
                                    Ver Ranking Oficial &darr;
                                </a>

                                {{-- LÓGICA DEL CERTIFICADO --}}
                                @if($isRegistered && optional($registration)->status === 'qualified')
                                    <form action="{{ route('concursos.certificate', $event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-3 bg-[#10b981]/20 hover:bg-[#10b981]/30 text-[#10b981] border border-[#10b981] rounded-lg text-sm font-bold transition text-center flex items-center justify-center gap-2 group">
                                            <i class="fas fa-certificate group-hover:scale-110 transition-transform"></i>
                                            Obtener Certificado
                                        </button>
                                    </form>
                                    <p class="text-[10px] text-gray-500 mt-2">
                                        Se enviará a: {{ Auth::user()->email }}
                                    </p>
                                @elseif($isRegistered && optional($registration)->status !== 'qualified')
                                    <div class="mt-4 p-3 bg-red-500/10 border border-red-500/20 rounded-lg">
                                        <p class="text-xs text-red-400">Tu equipo no alcanzó la clasificación para obtener certificado.</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>