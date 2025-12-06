<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-user text-cb-green mr-2"></i>
                Mi Perfil
            </h2>
            <a href="<?php echo e(route('profile.edit')); ?>" class="px-4 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-cog mr-2"></i>
                Configurar Cuenta
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            
            <?php if(session('success')): ?>
                <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-4xl font-bold text-cb-dark">
                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold text-white mb-2"><?php echo e($user->name); ?></h2>
                        <p class="text-gray-400 mb-1">
                            <i class="fas fa-envelope mr-2 text-cb-green"></i>
                            <?php echo e($user->email); ?>

                        </p>
                        <p class="text-gray-400">
                            <i class="fas fa-calendar mr-2 text-cb-green"></i>
                            Miembro desde <?php echo e($user->created_at->format('F Y')); ?>

                        </p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-cb-green">#<?php echo e($stats['global_ranking']); ?></div>
                        <div class="text-gray-400 text-sm">Ranking Global</div>
                    </div>
                </div>
            </div>

            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border text-center">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-code text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2"><?php echo e($stats['problems_solved']); ?></h3>
                    <p class="text-gray-400">Problemas Resueltos</p>
                </div>

                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border text-center">
                    <div class="w-16 h-16 bg-yellow-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-trophy text-3xl text-yellow-400"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2"><?php echo e($stats['contests_won']); ?></h3>
                    <p class="text-gray-400">Concursos Ganados</p>
                </div>

                <div class="bg-cb-card p-6 rounded-xl shadow-xl border border-cb-border text-center">
                    <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-3xl text-cb-green"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2"><?php echo e(number_format($stats['total_points'])); ?></h3>
                    <p class="text-gray-400">Puntos Totales</p>
                </div>
            </div>

            
            <div id="buscar-equipo" class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl shadow-xl p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-3xl text-cb-green"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Buscar Equipo por Código</h3>
                    <p class="text-gray-400">¿Te invitaron a un equipo? Ingresa el código de 5 dígitos</p>
                </div>

                <form method="POST" action="<?php echo e(route('teams.search')); ?>" class="max-w-md mx-auto">
                    <?php echo csrf_field(); ?>
                    <div class="flex gap-3">
                        <input type="text" 
                               name="team_code" 
                               maxlength="5" 
                               required
                               placeholder="Ej: A1B2C"
                               class="flex-1 bg-cb-dark border border-cb-border rounded-lg px-6 py-3 text-white text-center text-xl font-bold uppercase tracking-widest focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                        <button type="submit" class="px-8 py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition">
                            <i class="fas fa-search mr-2"></i>
                            Buscar
                        </button>
                    </div>
                    <p class="text-gray-400 text-sm mt-3 text-center">
                        <i class="fas fa-info-circle text-cb-green mr-1"></i>
                        El código distingue entre mayúsculas y minúsculas
                    </p>
                </form>
            </div>

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-trophy text-cb-green mr-3"></i>
                    Mis Equipos y Concursos
                </h3>

                <?php if($myContests->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $myContests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="p-4 bg-cb-dark/50 rounded-lg border border-cb-border hover:border-cb-green/50 transition">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-cb-green/10 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-trophy text-cb-green text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-bold"><?php echo e($registration->contest->name); ?></h4>
                                            <p class="text-gray-400 text-sm"><?php echo e($registration->contest->start_date->format('d M Y')); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <?php if($registration->is_public): ?>
                                            <span class="px-3 py-1 bg-green-500/20 text-green-400 border border-green-500 rounded-full text-xs font-semibold">
                                                <i class="fas fa-globe mr-1"></i>
                                                Público
                                            </span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 bg-gray-600/40 text-gray-300 border border-gray-500 rounded-full text-xs font-semibold">
                                                <i class="fas fa-lock mr-1"></i>
                                                Privado
                                            </span>
                                        <?php endif; ?>
                                        <?php if($registration->status == 'qualified'): ?>
                                            <span class="px-3 py-1 bg-cb-green/20 text-cb-green border border-cb-green rounded-full text-xs font-semibold">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Clasificado
                                            </span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500 rounded-full text-xs font-semibold">
                                                Registrado
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                
                                <div class="bg-cb-dark/50 border border-cb-border rounded-lg p-4 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-gray-400 text-xs mb-1">Nombre del Equipo</p>
                                            <p class="text-white font-bold text-lg"><?php echo e($registration->team_name); ?></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-400 text-xs mb-1">Código del Equipo</p>
                                            <div class="flex items-center space-x-2">
                                                <span class="text-cb-green font-bold text-xl tracking-wider"><?php echo e($registration->team_code); ?></span>
                                                <button onclick="copyToClipboard('<?php echo e($registration->team_code); ?>')" class="p-2 bg-cb-green/10 hover:bg-cb-green/20 text-cb-green rounded transition" title="Copiar código">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-3 border-t border-cb-border">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-gray-400 text-sm">
                                                <i class="fas fa-users text-cb-green mr-1"></i>
                                                <?php echo e($registration->current_members); ?>/<?php echo e($registration->max_members); ?> miembros
                                            </span>
                                            <?php if($registration->is_team_leader): ?>
                                                <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 border border-yellow-500 rounded text-xs font-bold">
                                                    <i class="fas fa-crown mr-1"></i>
                                                    Líder
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 py-1 bg-blue-500/20 text-blue-400 border border-blue-500 rounded text-xs font-bold">
                                                    <i class="fas fa-user mr-1"></i>
                                                    Miembro
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <form method="POST" action="<?php echo e(route('teams.search')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="team_code" value="<?php echo e($registration->team_code); ?>">
                                            <button type="submit" class="px-4 py-2 bg-cb-green/10 hover:bg-cb-green/20 text-cb-green border border-cb-green rounded-lg transition text-sm font-medium">
                                                <i class="fas fa-eye mr-1"></i>
                                                Ver Equipo
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-4xl text-gray-600 mb-4"></i>
                        <p class="text-gray-400 mb-4">No estás inscrito en ningún concurso</p>
                        <a href="<?php echo e(route('welcome')); ?>#concursos" class="px-6 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-trophy mr-2"></i>
                            Explorar Concursos
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-clock text-cb-green mr-3"></i>
                    Actividad Reciente
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 p-3 bg-cb-dark/50 rounded-lg">
                        <i class="fas fa-check-circle text-green-400 text-lg"></i>
                        <div class="flex-1">
                            <p class="text-white text-sm">Solución aceptada en "Two Sum Problem"</p>
                            <p class="text-gray-400 text-xs">Hace 2 horas</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-cb-dark/50 rounded-lg">
                        <i class="fas fa-trophy text-yellow-400 text-lg"></i>
                        <div class="flex-1">
                            <p class="text-white text-sm">¡Ganaste el Weekly Challenge #46!</p>
                            <p class="text-gray-400 text-xs">Hace 1 día</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-cb-dark/50 rounded-lg">
                        <i class="fas fa-star text-cb-green text-lg"></i>
                        <div class="flex-1">
                            <p class="text-white text-sm">Alcanzaste 4,500 puntos</p>
                            <p class="text-gray-400 text-xs">Hace 3 días</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Código copiado: ' + text);
            }, function(err) {
                alert('Error al copiar: ' + err);
            });
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/profile/index.blade.php ENDPATH**/ ?>