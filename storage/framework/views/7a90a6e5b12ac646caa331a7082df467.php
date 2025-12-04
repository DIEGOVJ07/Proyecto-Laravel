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
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-chart-bar text-cb-green mr-2"></i>
            Clasificación Global
        </h2>
        <p class="text-gray-400 text-sm mt-1">Los mejores programadores competitivos del mundo</p>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            
            <section>
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-star text-yellow-400 mr-3"></i>
                    Salón de la Fama
                </h3>

                <div class="grid md:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $hallOfFame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-cb-card p-8 rounded-xl shadow-xl border-2 transition duration-300 hover:scale-105
                            <?php if($index == 0): ?> border-yellow-400 bg-gradient-to-br from-yellow-900/20 to-cb-card
                            <?php elseif($index == 1): ?> border-gray-400 bg-gradient-to-br from-gray-700/20 to-cb-card
                            <?php else: ?> border-orange-600 bg-gradient-to-br from-orange-900/20 to-cb-card
                            <?php endif; ?>
                        ">
                            
                            <div class="text-center mb-6">
                                <div class="text-6xl mb-3">
                                    <?php if($index == 0): ?> 🏆
                                    <?php elseif($index == 1): ?> 👑
                                    <?php else: ?> ⚡
                                    <?php endif; ?>
                                </div>
                                <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center text-3xl font-bold text-white
                                    <?php if($index == 0): ?> bg-gradient-to-br from-yellow-400 to-yellow-600
                                    <?php elseif($index == 1): ?> bg-gradient-to-br from-gray-300 to-gray-500
                                    <?php else: ?> bg-gradient-to-br from-orange-400 to-orange-600
                                    <?php endif; ?>
                                ">
                                    <?php echo e(strtoupper(substr($entry->user->name, 0, 1))); ?>

                                </div>
                            </div>

                            
                            <h4 class="text-2xl font-bold text-white text-center mb-2"><?php echo e($entry->user->name); ?></h4>
                            <p class="text-center text-sm mb-6
                                <?php if($index == 0): ?> text-yellow-400
                                <?php elseif($index == 1): ?> text-gray-300
                                <?php else: ?> text-orange-400
                                <?php endif; ?>
                            ">
                                <?php if($index == 0): ?> Campeón CodeBattle 2024
                                <?php elseif($index == 1): ?> Mejor Algoritmo del Año
                                <?php else: ?> Racha de 50 Victorias
                                <?php endif; ?>
                            </p>

                            <div class="space-y-2 text-sm text-gray-400">
                                <div class="flex justify-between">
                                    <span>Puntos:</span>
                                    <span class="text-cb-green font-bold"><?php echo e(number_format($entry->total_points)); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Concursos ganados:</span>
                                    <span class="text-white font-bold"><?php echo e($entry->contests_won); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Problemas resueltos:</span>
                                    <span class="text-white font-bold"><?php echo e($entry->problems_solved); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>

            
            <section class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-cb-dark">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Rango</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Puntos</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Concursos Ganados</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Problemas Resueltos</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tendencia</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cb-border">
                            <?php $__currentLoopData = $topUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-cb-dark/50 transition">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-2xl">
                                            <?php if($entry->global_ranking == 1): ?>
                                                <span class="text-yellow-400">👑</span>
                                            <?php elseif($entry->global_ranking == 2): ?>
                                                <span class="text-gray-300">🥈</span>
                                            <?php elseif($entry->global_ranking == 3): ?>
                                                <span class="text-orange-400">🥉</span>
                                            <?php else: ?>
                                                <span class="text-gray-400 text-base font-bold">#<?php echo e($entry->global_ranking); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-lg flex items-center justify-center text-white font-bold">
                                                <?php echo e(strtoupper(substr($entry->user->name, 0, 1))); ?>

                                            </div>
                                            <div>
                                                <div class="text-white font-medium"><?php echo e($entry->user->name); ?></div>
                                                <div class="text-gray-400 text-xs"><?php echo e($entry->country_code); ?></div>
                                            </div>
                                        </div>
                                    </td>

                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-cb-green font-bold text-lg"><?php echo e(number_format($entry->total_points)); ?></span>
                                    </td>

                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-white font-medium flex items-center space-x-2">
                                            <i class="fas fa-trophy text-yellow-400"></i>
                                            <span><?php echo e($entry->contests_won); ?></span>
                                        </span>
                                    </td>

                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-white font-medium"><?php echo e($entry->problems_solved); ?></span>
                                    </td>

                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if($entry->trend == 'up'): ?>
                                            <i class="fas fa-arrow-up text-green-400"></i>
                                        <?php elseif($entry->trend == 'down'): ?>
                                            <i class="fas fa-arrow-down text-red-400"></i>
                                        <?php else: ?>
                                            <span class="text-gray-400">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="md:hidden p-4 space-y-4">
                    <?php $__currentLoopData = $topUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-cb-dark/50 rounded-xl p-4 border border-cb-border">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="text-2xl">
                                        <?php if($entry->global_ranking == 1): ?> 👑
                                        <?php elseif($entry->global_ranking == 2): ?> 🥈
                                        <?php elseif($entry->global_ranking == 3): ?> 🥉
                                        <?php else: ?> <span class="text-gray-400 font-bold">#<?php echo e($entry->global_ranking); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="w-12 h-12 bg-gradient-to-br from-cb-green to-green-600 rounded-lg flex items-center justify-center text-white font-bold">
                                        <?php echo e(strtoupper(substr($entry->user->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold"><?php echo e($entry->user->name); ?></h4>
                                        <p class="text-gray-400 text-xs"><?php echo e($entry->country_code); ?></p>
                                    </div>
                                </div>
                                <div>
                                    <?php if($entry->trend == 'up'): ?>
                                        <i class="fas fa-arrow-up text-green-400"></i>
                                    <?php elseif($entry->trend == 'down'): ?>
                                        <i class="fas fa-arrow-down text-red-400"></i>
                                    <?php else: ?>
                                        <span class="text-gray-400">—</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2 text-center">
                                <div>
                                    <p class="text-cb-green font-bold"><?php echo e(number_format($entry->total_points)); ?></p>
                                    <p class="text-gray-400 text-xs">Puntos</p>
                                </div>
                                <div>
                                    <p class="text-white font-bold"><?php echo e($entry->contests_won); ?></p>
                                    <p class="text-gray-400 text-xs">Ganados</p>
                                </div>
                                <div>
                                    <p class="text-white font-bold"><?php echo e($entry->problems_solved); ?></p>
                                    <p class="text-gray-400 text-xs">Resueltos</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>

            
            <?php if($userPosition): ?>
                <section class="bg-gradient-to-r from-cb-green/10 to-cb-card border-2 border-cb-green rounded-xl p-6">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-1">Tu Posición</h3>
                                <p class="text-3xl font-extrabold text-cb-green">#<?php echo e($userPosition->global_ranking); ?></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-8 text-center">
                            <div>
                                <p class="text-3xl font-bold text-white"><?php echo e(number_format($userPosition->total_points)); ?></p>
                                <p class="text-gray-400 text-sm">Puntos</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white"><?php echo e($userPosition->contests_won); ?></p>
                                <p class="text-gray-400 text-sm">Victorias</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-white"><?php echo e($userPosition->problems_solved); ?></p>
                                <p class="text-gray-400 text-sm">Resueltos</p>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/leaderboard/index.blade.php ENDPATH**/ ?>