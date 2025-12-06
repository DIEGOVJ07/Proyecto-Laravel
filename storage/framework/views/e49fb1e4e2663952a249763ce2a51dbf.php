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
            <i class="fas fa-users text-cb-green mr-2"></i>
            <?php echo e($team->team_name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            
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

            
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border overflow-hidden">
                <div class="bg-gradient-to-r from-cb-green/20 to-cb-card p-8 border-b border-cb-border">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-2"><?php echo e($team->team_name); ?></h3>
                            <p class="text-gray-400"><?php echo e($team->contest->name); ?></p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-cb-green"><?php echo e($team->team_code); ?></div>
                            <p class="text-gray-400 text-sm">Código</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6 text-sm">
                        <span class="px-3 py-1 <?php echo e($team->is_public ? 'bg-green-500/20 text-green-400 border border-green-500' : 'bg-gray-600/40 text-gray-300 border border-gray-500'); ?> rounded-full font-semibold">
                            <i class="fas <?php echo e($team->is_public ? 'fa-globe' : 'fa-lock'); ?> mr-1"></i>
                            <?php echo e($team->is_public ? 'Equipo Público' : 'Equipo Privado'); ?>

                        </span>
                        <span class="text-gray-400">
                            <i class="fas fa-users text-cb-green mr-1"></i>
                            <?php echo e($team->current_members); ?> / <?php echo e($team->max_members); ?> miembros
                        </span>
                    </div>
                </div>

                
                <div class="p-6 border-b border-cb-border">
                    <h4 class="text-white font-bold mb-4 flex items-center">
                        <i class="fas fa-crown text-yellow-400 mr-2"></i>
                        Líder del Equipo
                    </h4>
                    <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            <?php echo e(substr($team->user->name, 0, 1)); ?>

                        </div>
                        <div>
                            <p class="text-white font-medium"><?php echo e($team->user->name); ?></p>
                            <p class="text-gray-400 text-sm"><?php echo e($team->user->email); ?></p>
                        </div>
                    </div>
                </div>

                
                <div class="p-6">
                    <h4 class="text-white font-bold mb-4 flex items-center">
                        <i class="fas fa-users text-cb-green mr-2"></i>
                        Miembros del Equipo (<?php echo e($team->current_members); ?>)
                    </h4>

                    <?php if($team->members->count() > 0): ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $team->members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center space-x-4 p-4 bg-cb-dark/50 rounded-lg">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                        <?php echo e(substr($member->user->name, 0, 1)); ?>

                                    </div>
                                    <div class="flex-1">
                                        <p class="text-white font-medium"><?php echo e($member->user->name); ?></p>
                                        <p class="text-gray-400 text-sm"><?php echo e($member->user->email); ?></p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-500/20 text-green-400 border border-green-500 rounded-full text-xs font-semibold">
                                        Miembro
                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-400 text-center py-4">Solo el líder está en el equipo</p>
                    <?php endif; ?>

                    
                    <?php if($team->current_members < $team->max_members): ?>
                        <div class="mt-4 space-y-2">
                            <?php for($i = $team->current_members; $i < $team->max_members; $i++): ?>
                                <div class="flex items-center space-x-4 p-4 bg-cb-dark/30 rounded-lg border-2 border-dashed border-cb-border">
                                    <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-gray-500">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <p class="text-gray-500 italic">Espacio disponible</p>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>

                
                <?php if(!$team->hasUser(Auth::id())): ?>
                    <div class="p-6 border-t border-cb-border bg-cb-dark/30">
                        <?php if($team->isFull()): ?>
                            <button disabled class="w-full bg-gray-600 text-gray-400 font-bold py-3 px-6 rounded-lg cursor-not-allowed">
                                <i class="fas fa-users-slash mr-2"></i>
                                Equipo Completo
                            </button>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('teams.join', $team->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-6 rounded-lg transition">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Unirme al Equipo
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="p-6 border-t border-cb-border bg-green-500/10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-green-400">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <span class="font-bold">Ya eres miembro de este equipo</span>
                            </div>
                            <?php if($team->user_id != Auth::id()): ?>
                                <form method="POST" action="<?php echo e(route('teams.leave', $team->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500 rounded-lg transition" onclick="return confirm('¿Seguro que quieres salir del equipo?')">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Salir del Equipo
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="text-center">
                <a href="<?php echo e(route('profile.index')); ?>" class="inline-block px-6 py-3 bg-cb-border hover:bg-gray-600 text-white font-bold rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver a Mi Perfil
                </a>
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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/teams/show.blade.php ENDPATH**/ ?>