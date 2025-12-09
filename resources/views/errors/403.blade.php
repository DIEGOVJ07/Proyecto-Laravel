<x-app-layout>
    <div class="min-h-screen flex flex-col justify-center items-center text-center bg-cb-dark text-white">
        
        {{-- Cara x_x animada --}}
        <div class="text-9xl font-extrabold text-cb-green mb-4 animate-pulse">
            x_x
        </div>

        {{-- Código y Título --}}
        <h1 class="text-5xl font-bold mb-2 text-white">403</h1>
        <h2 class="text-2xl font-semibold uppercase tracking-widest text-gray-400 mb-8">
            Prohibido
        </h2>

        {{-- Mensaje amigable --}}
        <p class="text-gray-300 max-w-lg mx-auto mb-10 text-lg">
            Lo sentimos, pero no tienes los permisos necesarios para acceder a esta página. 
            Parece que te has topado con un firewall mental.
        </p>

        {{-- Botón de regreso --}}
        <a href="{{ url('/') }}" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition duration-300 shadow-lg shadow-green-500/20">
            <i class="fas fa-undo mr-2"></i> Volver al Inicio
        </a>

    </div>
</x-app-layout>