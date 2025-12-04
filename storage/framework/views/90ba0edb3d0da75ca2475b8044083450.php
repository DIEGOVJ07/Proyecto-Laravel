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
                <i class="fas fa-gavel text-cb-green mr-2"></i>
                Gestión de Jueces
            </h2>
            <a href="<?php echo e(route('admin.judges.create')); ?>" class="px-4 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                <i class="fas fa-plus mr-2"></i>
                Agregar Juez
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

            
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Total Jueces</p>
                            <p class="text-3xl font-bold text-white"><?php echo e($stats['total_judges']); ?></p>
                        </div>
                        <div class="w-14 h-14 bg-cb-green/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-cb-green text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Jueces Activos</p>
                            <p class="text-3xl font-bold text-white"><?php echo e($stats['active_judges']); ?></p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-check text-blue-400 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Expertos</p>
                            <p class="text-3xl font-bold text-white"><?php echo e($stats['expert_judges']); ?></p>
                        </div>
                        <div class="w-14 h-14 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trophy text-yellow-400 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-cb-card p-6 rounded-xl border border-cb-border">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Asignaciones</p>
                            <p class="text-3xl font-bold text-white"><?php echo e($stats['total_assignments']); ?></p>
                        </div>
                        <div class="w-14 h-14 bg-purple-500/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-purple-400 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <table class="w-full">
                    <thead class="bg-cb-dark">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Juez</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Especialidad</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Nivel</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Experiencia</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Concursos</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Estado</th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cb-border">
                        <?php $__empty_1 = true; $__currentLoopData = $judges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $judge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-cb-dark/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            <?php echo e($judge->getInitials()); ?>

                                        </div>
                                        <div>
                                            <div class="text-white font-medium"><?php echo e($judge->name); ?></div>
                                            <div class="text-gray-400 text-sm"><?php echo e($judge->email); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-white"><?php echo e($judge->specialty); ?></span>
                                    <?php if($judge->institution): ?>
                                        <div class="text-gray-400 text-xs"><?php echo e($judge->institution); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $judge->getCertificationBadge(); ?>

                                </td>
                                <td class="px-6 py-4 text-white">
                                    <?php echo e($judge->experience_years); ?> años
                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('admin.judges.assignments', $judge)); ?>" class="text-cb-green hover:text-green-400 font-medium">
                                        <?php echo e($judge->contests_count); ?> asignaciones
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="<?php echo e(route('admin.judges.toggle-status', $judge)); ?>" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-full transition
                                            <?php if($judge->is_active): ?> 
                                                bg-green-500/20 text-green-400 border border-green-500 hover:bg-green-500/30
                                            <?php else: ?> 
                                                bg-red-500/20 text-red-400 border border-red-500 hover:bg-red-500/30
                                            <?php endif; ?>
                                        ">
                                            <?php echo e($judge->is_active ? 'Activo' : 'Inactivo'); ?>

                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="<?php echo e(route('admin.judges.assignments', $judge)); ?>" class="p-2 bg-purple-500/10 text-purple-400 rounded hover:bg-purple-500/20 transition" title="Ver asignaciones">
                                            <i class="fas fa-clipboard-list"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.judges.edit', $judge)); ?>" class="p-2 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500/20 transition" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="<?php echo e(route('admin.judges.destroy', $judge)); ?>" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-2 bg-red-500/10 text-red-400 rounded hover:bg-red-500/20 transition" title="Eliminar" onclick="return confirm('¿Eliminar este juez? Esta acción no se puede deshacer.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    <i class="fas fa-inbox text-4xl mb-4"></i>
                                    <p>No hay jueces registrados</p>
                                    <a href="<?php echo e(route('admin.judges.create')); ?>" class="mt-4 inline-block px-6 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Primer Juez
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-6">
                <?php echo e($judges->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/admin/judges/index.blade.php ENDPATH**/ ?>