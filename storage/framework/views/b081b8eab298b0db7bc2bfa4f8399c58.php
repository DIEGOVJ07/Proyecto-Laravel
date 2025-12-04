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
            <div>
                <h2 class="font-semibold text-2xl text-white leading-tight">
                    <i class="fas fa-users text-cb-green mr-2"></i>
                    Equipos Participantes
                </h2>
                <p class="text-gray-400 text-sm mt-1"><?php echo e($contest->name); ?></p>
            </div>
            <a href="<?php echo e(route('admin.contests.index')); ?>" class="px-4 py-2 bg-cb-border text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6 mb-6">
                <div class="grid md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-gray-400 text-sm">Estado</p>
                        <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full
                            <?php if($contest->status == 'Activo'): ?> bg-cb-green/20 text-cb-green border border-cb-green
                            <?php elseif($contest->status == 'Próximamente'): ?> bg-blue-900/40 text-blue-300 border border-blue-600
                            <?php else: ?> bg-gray-600/40 text-gray-300 border border-gray-500
                            <?php endif; ?>
                        ">
                            <?php echo e($contest->status); ?>

                        </span>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Equipos Registrados</p>
                        <p class="text-white font-bold text-2xl mt-1"><?php echo e($contest->registrations->count()); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Equipos Clasificados</p>
                        <p class="text-cb-green font-bold text-2xl mt-1"><?php echo e($contest->registrations->where('status', 'qualified')->count()); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Fecha del Concurso</p>
                        <p class="text-white font-bold mt-1"><?php echo e($contest->start_date->format('d/m/Y')); ?></p>
                    </div>
                </div>
            </div>

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="p-6 border-b border-cb-border">
                    <h3 class="text-xl font-bold text-white">
                        <i class="fas fa-list mr-2 text-cb-green"></i>
                        Lista de Equipos
                    </h3>
                </div>

                <div class="divide-y divide-cb-border">
                    <?php $__empty_1 = true; $__currentLoopData = $contest->registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-6 hover:bg-cb-dark/50 transition">
                            <div class="flex items-start justify-between">
                                
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <h4 class="text-xl font-bold text-white"><?php echo e($registration->team_name); ?></h4>
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

                                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-user text-cb-green mr-2"></i>
                                                Líder: <span class="text-white font-medium"><?php echo e($registration->user->name); ?></span>
                                            </p>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-envelope text-cb-green mr-2"></i>
                                                Email: <span class="text-white"><?php echo e($registration->user->email); ?></span>
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-phone text-cb-green mr-2"></i>
                                                Teléfono: <span class="text-white"><?php echo e($registration->leader_phone); ?></span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-gray-400 text-sm mb-2">
                                                <i class="fas fa-users text-cb-green mr-2"></i>
                                                Integrantes: <span class="text-white font-medium"><?php echo e($registration->team_size); ?></span>
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                <i class="fas fa-calendar text-cb-green mr-2"></i>
                                                Registrado: <span class="text-white"><?php echo e($registration->created_at->format('d/m/Y H:i')); ?></span>
                                            </p>
                                        </div>
                                    </div>

                                    
                                    <div class="mt-4">
                                        <p class="text-gray-400 text-sm font-medium mb-3">
                                            <i class="fas fa-id-card text-cb-green mr-2"></i>
                                            Miembros del Equipo:
                                        </p>
                                        <div class="grid md:grid-cols-2 gap-3">
                                            <?php $__currentLoopData = $registration->team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="flex items-center space-x-3 bg-cb-dark/50 p-3 rounded-lg">
                                                    <div class="w-8 h-8 bg-cb-green/10 rounded-full flex items-center justify-center">
                                                        <span class="text-cb-green font-bold text-sm"><?php echo e($index + 1); ?></span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="text-white font-medium text-sm"><?php echo e($member['name']); ?></p>
                                                        <p class="text-gray-400 text-xs">
                                                            Nac: <?php echo e(\Carbon\Carbon::parse($member['birthdate'])->format('d/m/Y')); ?>

                                                            (<?php echo e(\Carbon\Carbon::parse($member['birthdate'])->age); ?> años)
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="ml-6 flex flex-col space-y-2">
                                    <?php if($registration->status == 'qualified'): ?>
                                        <form method="POST" action="<?php echo e(route('admin.contests.teams.disqualify', [$contest->id, $registration->id])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="w-full px-4 py-2 bg-yellow-500/10 text-yellow-400 border border-yellow-500 rounded-lg hover:bg-yellow-500/20 transition text-sm font-medium" onclick="return confirm('¿Desclasificar este equipo?')">
                                                <i class="fas fa-times-circle mr-2"></i>
                                                Desclasificar
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form method="POST" action="<?php echo e(route('admin.contests.teams.qualify', [$contest->id, $registration->id])); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="w-full px-4 py-2 bg-cb-green/10 text-cb-green border border-cb-green rounded-lg hover:bg-cb-green/20 transition text-sm font-medium" onclick="return confirm('¿Clasificar este equipo?')">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Clasificar
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <form method="POST" action="<?php echo e(route('admin.contests.teams.delete', [$contest->id, $registration->id])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-full px-4 py-2 bg-red-500/10 text-red-400 border border-red-500 rounded-lg hover:bg-red-500/20 transition text-sm font-medium" onclick="return confirm('¿Eliminar este equipo? Esta acción no se puede deshacer.')">
                                            <i class="fas fa-trash mr-2"></i>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="p-12 text-center">
                            <i class="fas fa-users-slash text-4xl text-gray-600 mb-4"></i>
                            <p class="text-gray-400">No hay equipos registrados en este concurso</p>
                        </div>
                    <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/admin/contests/teams.blade.php ENDPATH**/ ?>