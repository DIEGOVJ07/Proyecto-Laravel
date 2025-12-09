<x-app-layout>
    <div class="min-h-screen flex flex-col justify-center items-center text-center bg-cb-dark text-white p-4">
        
        {{-- Cara durmiendo ( -_-) zZ --}}
        <div class="text-9xl font-extrabold text-cb-green mb-6 flex items-center justify-center">
            <span>( -_-)</span>
            <span class="text-6xl ml-4 animate-pulse">zZ</span>
        </div>

        {{-- Código y Título --}}
        <h1 class="text-5xl font-bold mb-2 text-white">419</h1>
        <h2 class="text-2xl font-semibold uppercase tracking-widest text-gray-400 mb-8">
            La página ha expirado
        </h2>

        {{-- Mensaje estilo Programación Competitiva --}}
        <div class="text-gray-300 max-w-lg mx-auto mb-10 text-lg space-y-2">
            <p>
                Parece que te has tomado demasiado tiempo para realizar esta acción.
            </p>
            <p class="text-cb-green font-mono bg-cb-dark/50 p-2 rounded border border-cb-green/30 inline-block">
                Error: Time Limit Exceeded (TLE)
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Tu token de sesión se ha ido al recolector de basura (Garbage Collector).
            </p>
        </div>

       {{-- Botón de regreso --}}
        <a href="{{ url('/') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition duration-300 shadow-lg shadow-green-500/20">
            <i class="fas fa-undo mr-2"></i> Volver al Inicio
        </a>


    </div>
    
    {{-- Estilo extra para que el icono gire lento si quieres --}}
    <style>
        .animate-spin-slow {
            animation: spin 3s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</x-app-layout>