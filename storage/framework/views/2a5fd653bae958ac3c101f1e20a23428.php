<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeBattle - Plataforma de Programación Competitiva</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cb-dark': '#0D1421',
                        'cb-card': '#141D2D',
                        'cb-green': '#10B981',
                        'cb-border': '#29374D',
                    },
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="font-sans antialiased bg-cb-dark text-white">
    <div class="min-h-screen">

        <header class="sticky top-0 z-50 bg-cb-card shadow-lg border-b border-cb-border">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <a href="<?php echo e(route('welcome')); ?>" class="text-2xl font-extrabold text-cb-green flex items-center space-x-2">
                            <i class="fas fa-terminal"></i>
                            <span>CodeBattle</span>
                        </a>
                    </div>

                    <nav class="hidden sm:flex sm:space-x-8">
                        <a href="<?php echo e(route('welcome')); ?>" class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('welcome') ? 'border-cb-green text-white' : 'border-transparent text-gray-300'); ?> text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                            Inicio
                        </a>
                        <a href="#concursos" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-300 hover:text-white hover:border-cb-green transition duration-150">
                            Concursos
                        </a>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('leaderboard.index')); ?>" class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('leaderboard.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300'); ?> text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                Clasificación
                            </a>
                            <a href="<?php echo e(route('profile.index')); ?>" class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('profile.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300'); ?> text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                Mi Perfil
                            </a>
                            <a href="<?php echo e(route('blog.index')); ?>" class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('blog.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300'); ?> text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                Blog
                            </a>
                            <a href="<?php echo e(route('venues.index')); ?>" class="inline-flex items-center px-1 pt-1 border-b-2 <?php echo e(request()->routeIs('venues.index') ? 'border-cb-green text-white' : 'border-transparent text-gray-300'); ?> text-sm font-medium hover:text-white hover:border-cb-green transition duration-150">
                                Sedes
                            </a>
                        <?php endif; ?>
                    </nav>

                    <div class="flex items-center">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('profile.index')); ?>" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 shadow-xl">
                                Ver Mi Perfil
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-2 px-6 rounded-lg transition duration-300 shadow-xl">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Iniciar Sesión
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

                <section class="text-center pt-10 pb-16">
                    <p class="text-cb-green font-semibold mb-4 text-sm uppercase tracking-wider">
                        # Plataforma de Programación Competitiva
                    </p>
                    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                        Codifica el futuro. <br>
                        <span class="text-cb-green">Gana hoy.</span>
                    </h1>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-8">
                        Únete a la comunidad de desarrolladores más competitiva. Resuelve desafíos, compite en tiempo real y lleva tus habilidades al siguiente nivel.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('profile.index')); ?>" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                                Ver Mi Perfil →
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="bg-cb-green hover:bg-emerald-600 text-cb-dark font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                                Comenzar Ahora →
                            </a>
                        <?php endif; ?>
                        <a href="#concursos" class="border-2 border-cb-border text-white hover:bg-cb-border py-3 px-8 rounded-lg text-lg transition duration-300 inline-flex items-center justify-center">
                            Ver Concursos
                        </a>
                    </div>
                </section>

                <section class="py-16">
                    <h2 class="text-3xl font-bold text-center mb-12 text-white">¿Por qué CodeBattle?</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-trophy text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Competencia Real</h3>
                            <p class="text-gray-400">Enfrenta a programadores de todo el mundo en desafíos en tiempo real</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Mejora Continua</h3>
                            <p class="text-gray-400">Rastrea tu progreso y mejora tus habilidades con cada desafío</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-3xl text-cb-green"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-white">Comunidad Activa</h3>
                            <p class="text-gray-400">Únete a miles de desarrolladores apasionados por la programación</p>
                        </div>
                    </div>
                </section>

                <section id="concursos" class="py-20">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-extrabold text-white mb-4">
                            <i class="fas fa-trophy text-cb-green mr-3"></i>
                            Concursos Disponibles
                        </h2>
                        <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                            Elige tu desafío y demuestra tus habilidades de programación
                        </p>
                    </div>

                    <?php if($contests->count() > 0): ?>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <?php $__currentLoopData = $contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-cb-card rounded-xl shadow-2xl border border-cb-border hover:border-cb-green transition duration-300 overflow-hidden group">
                                    <div class="bg-gradient-to-r from-cb-green/20 to-cb-dark p-6 border-b border-cb-border">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                                <?php if($contest->status == 'Activo'): ?> bg-cb-green/20 text-cb-green border border-cb-green
                                                <?php else: ?> bg-blue-900/40 text-blue-300 border border-blue-600
                                                <?php endif; ?>
                                            ">
                                                <?php echo e($contest->status); ?>

                                            </span>
                                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                                <?php if($contest->difficulty == 'Difícil'): ?> bg-red-900/40 text-red-300 border border-red-600
                                                <?php elseif($contest->difficulty == 'Medio'): ?> bg-yellow-900/40 text-yellow-300 border border-yellow-600
                                                <?php else: ?> bg-green-900/40 text-green-300 border border-green-600
                                                <?php endif; ?>
                                            ">
                                                <?php echo e($contest->difficulty); ?>

                                            </span>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white group-hover:text-cb-green transition">
                                            <?php echo e($contest->name); ?>

                                        </h3>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <p class="text-gray-400 text-sm line-clamp-2">
                                            <?php echo e($contest->description); ?>

                                        </p>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-calendar text-cb-green"></i>
                                                <span class="text-gray-400"><?php echo e($contest->start_date->format('d/m/Y')); ?></span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-clock text-cb-green"></i>
                                                <span class="text-gray-400"><?php echo e($contest->duration); ?></span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-users text-cb-green"></i>
                                                <span class="text-gray-400"><?php echo e($contest->participants); ?> personas</span>
                                            </div>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <i class="fas fa-trophy text-cb-green"></i>
                                                <span class="text-gray-400">$<?php echo e(number_format($contest->prize, 0)); ?></span>
                                            </div>
                                        </div>

                                        <?php if($contest->languages && is_array($contest->languages) && count($contest->languages) > 0): ?>
                                            <div class="flex flex-wrap gap-2">
                                                <?php $__currentLoopData = array_slice($contest->languages, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="px-2 py-1 bg-cb-green/10 text-cb-green border border-cb-green/30 rounded text-xs font-medium">
                                                        <?php echo e($language); ?>

                                                    </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(count($contest->languages) > 3): ?>
                                                    <span class="px-2 py-1 bg-gray-700 text-gray-400 rounded text-xs">
                                                        +<?php echo e(count($contest->languages) - 3); ?> más
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(auth()->guard()->check()): ?>
                                            <a href="<?php echo e(route('contests.show', $contest->id)); ?>" class="block w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-4 rounded-lg text-center transition">
                                                Ver Detalles
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('login')); ?>" class="block w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-4 rounded-lg text-center transition">
                                                Inicia Sesión para Participar
                                                <i class="fas fa-sign-in-alt ml-2"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-trophy text-cb-green text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">
                                No hay concursos disponibles en este momento
                            </h3>
                            <p class="text-gray-400 mb-8">
                                Los nuevos desafíos se publicarán pronto. ¡Mantente atento!
                            </p>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(Auth::user()->isAdmin()): ?>
                                    <a href="<?php echo e(route('admin.contests.create')); ?>" class="inline-block bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                                        <i class="fas fa-plus mr-2"></i>
                                        Crear Primer Concurso
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </section>

            </div>
        </main>

        <footer class="mt-20 border-t border-cb-border bg-cb-card pt-10 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div>
                        <div class="text-2xl font-extrabold text-cb-green mb-3 flex items-center space-x-2">
                            <i class="fas fa-terminal"></i>
                            <span>CodeBattle</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            La plataforma líder de programación competitiva en México y Latinoamérica.
                        </p>
                    </div>
                    <div>
                        <h5 class="text-white font-bold mb-4">Plataforma</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Cómo funciona</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Reglas y términos</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-white font-bold mb-4">Comunidad</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Discord</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Foro</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-white font-bold mb-4">Compañía</h5>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-cb-green transition">Acerca de</a></li>
                            <li><a href="#" class="hover:text-cb-green transition">Contacto</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-10 pt-6 border-t border-cb-border text-center text-sm text-gray-500">
                    <p>© 2025 CodeBattle. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>

    </div>
</body>
</html><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/welcome.blade.php ENDPATH**/ ?>