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

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-trophy text-cb-green mr-3"></i>
                    Mis Concursos Inscritos
                </h3>

                <?php if($myContests->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $myContests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between p-4 bg-cb-dark/50 rounded-lg border border-cb-border hover:border-cb-green/50 transition">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-cb-green/10 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-trophy text-cb-green text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold"><?php echo e($registration->contest->name); ?></h4>
                                        <p class="text-gray-400 text-sm">Equipo: <?php echo e($registration->team_name); ?> (<?php echo e($registration->team_size); ?> miembros)</p>
                                    </div>
                                </div>
                                <div class="text-right">
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
                                    <p class="text-gray-400 text-sm mt-2"><?php echo e($registration->contest->start_date->format('d M Y')); ?></p>
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