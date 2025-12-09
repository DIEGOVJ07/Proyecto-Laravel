<x-app-layout>
    <div class="min-h-screen flex flex-col justify-center items-center text-center bg-cb-dark text-white">
        
        {{-- Cara x_x animada --}}
        <div class="text-9xl font-extrabold text-cb-green mb-4 animate-pulse">
            ¯\_(ツ)_/¯
        </div>

        {{-- Código y Título --}}
        <h1 class="text-5xl font-bold mb-2 text-white">404</h1>
        <h2 class="text-2xl font-semibold uppercase tracking-widest text-gray-400 mb-8">
            Página No Encontrada
        </h2>

        {{-- Mensaje amigable --}}
        <p class="text-gray-300 max-w-lg mx-auto mb-10 text-lg">
          Lo sentimos, la página que intentas ver no existe. Parece que alguien olvidó hacer el git push de este archivo
        </p>

        {{-- Botón de regreso --}}
        <a href="{{ url('/') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition duration-300 shadow-lg shadow-green-500/20">
            <i class="fas fa-undo mr-2"></i> Volver al Inicio
        </a>

    </div>
</x-app-layout>