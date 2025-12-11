<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificación - CodeBattle</title>

    {{-- Importamos los estilos de Tailwind y Scripts igual que en el resto de la app --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- FontAwesome para los iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans antialiased">
    
    {{-- FONDO PRINCIPAL QUE OCUPA EL 100% DE LA PANTALLA --}}
    <div class="bg-[#0f111a] min-h-screen flex flex-col justify-center items-center p-4">
        
        {{-- Logo estilo CodeBattle --}}
        <div class="mb-8 text-center animate-fade-in-down">
            <h1 class="text-5xl font-extrabold text-white tracking-tight flex items-center gap-3 justify-center">
                <i class="fas fa-code text-[#10b981]"></i>
                <span>Code<span class="text-[#10b981]">Battle</span></span>
            </h1>
        </div>

        {{-- Tarjeta Central --}}
        <div class="w-full sm:max-w-md bg-[#151a25] border border-[#2c3240] shadow-[0_0_40px_rgba(16,185,129,0.1)] rounded-2xl overflow-hidden relative group">
            
            {{-- Efecto de brillo superior --}}
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#10b981] to-transparent opacity-50"></div>

            <div class="px-8 py-10">
                {{-- Icono Central --}}
                <div class="mb-8 flex justify-center">
                    <div class="w-24 h-24 rounded-full bg-[#10b981]/5 border border-[#10b981]/20 flex items-center justify-center relative">
                        <div class="absolute inset-0 rounded-full bg-[#10b981]/10 animate-ping opacity-20"></div>
                        <i class="fas fa-envelope-open-text text-4xl text-[#10b981]"></i>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-white text-center mb-4">
                    Verifica tu Correo
                </h2>

                <p class="text-sm text-gray-400 text-center leading-relaxed mb-8">
                    Gracias por unirte. Hemos enviado un enlace de confirmación a tu correo. <br>
                    <span class="text-xs text-gray-500">(Revisa también tu carpeta de Spam)</span>
                </p>

                {{-- Mensaje Flash de Éxito --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-[#10b981]/10 border border-[#10b981]/30 rounded-xl flex items-start gap-3 animate-pulse-slow">
                        <i class="fas fa-check-circle text-[#10b981] mt-0.5"></i>
                        <div class="text-sm text-gray-200">
                            ¡Listo! Te acabamos de enviar un nuevo enlace de verificación.
                        </div>
                    </div>
                @endif

                {{-- Botones --}}
                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                        @csrf
                        <button 
                            type="submit" 
                            id="resendButton"
                            class="w-full py-3.5 bg-[#10b981] hover:bg-[#059669] text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-[#10b981]/20 hover:shadow-[#10b981]/40 hover:-translate-y-0.5 flex items-center justify-center gap-2 uppercase tracking-wide text-xs disabled:bg-gray-600 disabled:cursor-not-allowed disabled:hover:transform-none disabled:shadow-none"
                        >
                            <i class="fas fa-paper-plane"></i> 
                            <span id="buttonText">Reenviar Correo</span>
                        </button>
                    </form>

                    <div class="flex justify-between items-center pt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs font-medium text-gray-500 hover:text-white transition-colors flex items-center gap-1.5">
                                <i class="fas fa-arrow-left"></i> Cerrar Sesión
                            </button>
                        </form>

                        <a href="{{ route('profile.edit') }}" class="text-xs font-medium text-[#10b981] hover:text-[#34d399] transition-colors">
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Footer --}}
        <p class="mt-8 text-xs text-gray-600">
            &copy; {{ date('Y') }} CodeBattle Platform.
        </p>
    </div>

    <script>
        // Verificar si hay un cooldown activo al cargar la página
        window.addEventListener('DOMContentLoaded', function() {
            checkCooldown();
        });

        document.getElementById('resendForm').addEventListener('submit', function(e) {
            const button = document.getElementById('resendButton');
            const buttonText = document.getElementById('buttonText');
            
            // Deshabilitar el botón inmediatamente
            button.disabled = true;
            buttonText.textContent = 'Enviando...';
            
            // Guardar el timestamp del envío
            localStorage.setItem('emailResendTime', Date.now());
        });

        // Verificar si hay un cooldown activo
        function checkCooldown() {
            const lastResendTime = localStorage.getItem('emailResendTime');
            
            if (lastResendTime) {
                const elapsedTime = Date.now() - parseInt(lastResendTime);
                const cooldownTime = 60000; // 60 segundos en milisegundos
                
                if (elapsedTime < cooldownTime) {
                    startCooldown(Math.ceil((cooldownTime - elapsedTime) / 1000));
                }
            }
        }

        // Iniciar el temporizador de cooldown
        function startCooldown(secondsRemaining) {
            const button = document.getElementById('resendButton');
            const buttonText = document.getElementById('buttonText');
            
            button.disabled = true;
            
            const countdown = setInterval(function() {
                if (secondsRemaining <= 0) {
                    clearInterval(countdown);
                    button.disabled = false;
                    buttonText.textContent = 'Reenviar Correo';
                    localStorage.removeItem('emailResendTime');
                } else {
                    buttonText.textContent = `Espera ${secondsRemaining}s`;
                    secondsRemaining--;
                }
            }, 1000);
        }

        // Si se acaba de enviar un correo (detectar mensaje flash)
        @if (session('status') == 'verification-link-sent')
            startCooldown(60);
        @endif
    </script>

</body>
</html>