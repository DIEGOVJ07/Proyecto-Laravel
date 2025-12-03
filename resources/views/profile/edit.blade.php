<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @auth
                {{ __('Profile') }}
            @else
                {{ __('Perfil (Invitado)') }}
            @endauth
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            

            {{-- 🔴 SI NO ESTÁ LOGUEADO: Mostrar mensaje amigable --}}
            @guest
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-3">
                        Estás viendo el perfil en modo invitado
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Cuando crees una cuenta o inicies sesión, aquí podrás modificar tu información,
                        contraseña y configuración.
                    </p>

                    <a href="{{ route('register') }}"
                       class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-lg transition">
                       Crear cuenta
                    </a>

                    <a href="{{ route('login') }}"
                       class="ml-3 border border-gray-500 text-gray-200 hover:bg-gray-700 py-2 px-6 rounded-lg transition">
                       Iniciar sesión
                    </a>
                </div>
            @endguest

        </div>
    </div>
</x-app-layout>
