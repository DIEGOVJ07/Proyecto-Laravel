<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Actualizar Contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Asegúrate de que tu cuenta utiliza una contraseña larga y aleatoria para mantener la seguridad.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Contraseña Actual')" class="text-white" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full bg-cb-dark border-cb-border text-white" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Nueva Contraseña')" class="text-white" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full bg-cb-dark border-cb-border text-white" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-white" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-cb-dark border-cb-border text-white" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-cb-green hover:bg-green-700 active:bg-green-700 focus:ring-cb-green">
                {{ __('Guardar') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>