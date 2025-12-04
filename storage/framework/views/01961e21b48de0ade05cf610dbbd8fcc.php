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
                <i class="fas fa-plus-circle text-cb-green mr-2"></i>
                Crear Nuevo Concurso
            </h2>
            <a href="<?php echo e(route('admin.contests.index')); ?>" class="px-4 py-2 bg-cb-border text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <form method="POST" action="<?php echo e(route('admin.contests.store')); ?>">
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-trophy text-cb-green mr-2"></i>
                            Nombre del Concurso *
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="<?php echo e(old('name')); ?>"
                            required
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Ej: Weekly Challenge #48"
                        >
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-align-left text-cb-green mr-2"></i>
                            Descripción *
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="3"
                            required
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Descripción breve del concurso"
                        ><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-info-circle text-cb-green mr-2"></i>
                                Estado *
                            </label>
                            <select 
                                id="status" 
                                name="status" 
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                                <option value="Activo" <?php echo e(old('status') == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                <option value="Próximamente" <?php echo e(old('status') == 'Próximamente' ? 'selected' : ''); ?>>Próximamente</option>
                                <option value="Finalizado" <?php echo e(old('status') == 'Finalizado' ? 'selected' : ''); ?>>Finalizado</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-chart-bar text-cb-green mr-2"></i>
                                Dificultad *
                            </label>
                            <select 
                                id="difficulty" 
                                name="difficulty" 
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                                <option value="Fácil" <?php echo e(old('difficulty') == 'Fácil' ? 'selected' : ''); ?>>Fácil</option>
                                <option value="Medio" <?php echo e(old('difficulty') == 'Medio' ? 'selected' : ''); ?>>Medio</option>
                                <option value="Difícil" <?php echo e(old('difficulty') == 'Difícil' ? 'selected' : ''); ?>>Difícil</option>
                            </select>
                            <?php $__errorArgs = ['difficulty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="far fa-clock text-cb-green mr-2"></i>
                                Duración *
                            </label>
                            <input 
                                type="text" 
                                id="duration" 
                                name="duration" 
                                value="<?php echo e(old('duration')); ?>"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                                placeholder="Ej: 2 horas"
                            >
                            <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="prize" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-dollar-sign text-cb-green mr-2"></i>
                                Premio (USD) *
                            </label>
                            <input 
                                type="number" 
                                id="prize" 
                                name="prize" 
                                value="<?php echo e(old('prize')); ?>"
                                min="0"
                                step="0.01"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                                placeholder="1000"
                            >
                            <?php $__errorArgs = ['prize'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="far fa-calendar-alt text-cb-green mr-2"></i>
                                Fecha de Inicio *
                            </label>
                            <input 
                                type="date" 
                                id="start_date" 
                                name="start_date" 
                                value="<?php echo e(old('start_date')); ?>"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="far fa-calendar-check text-cb-green mr-2"></i>
                                Fecha de Fin *
                            </label>
                            <input 
                                type="date" 
                                id="end_date" 
                                name="end_date" 
                                value="<?php echo e(old('end_date')); ?>"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-code text-cb-green mr-2"></i>
                            Lenguajes Permitidos * (Selecciona al menos uno)
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <?php $__currentLoopData = ['Python', 'Java', 'C++', 'JavaScript', 'C#', 'Ruby', 'Go', 'Rust']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center space-x-2 bg-cb-dark p-3 rounded-lg cursor-pointer hover:bg-cb-border transition">
                                    <input 
                                        type="checkbox" 
                                        name="languages[]" 
                                        value="<?php echo e($lang); ?>"
                                        <?php echo e(is_array(old('languages')) && in_array($lang, old('languages')) ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-cb-green bg-cb-card border-cb-border rounded focus:ring-cb-green"
                                    >
                                    <span class="text-white text-sm"><?php echo e($lang); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['languages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="min_team_members" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-users text-cb-green mr-2"></i>
                                Mínimo de Integrantes *
                            </label>
                            <input 
                                type="number" 
                                id="min_team_members" 
                                name="min_team_members" 
                                value="<?php echo e(old('min_team_members', 1)); ?>"
                                min="1"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            <?php $__errorArgs = ['min_team_members'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="max_team_members" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-user-friends text-cb-green mr-2"></i>
                                Máximo de Integrantes *
                            </label>
                            <input 
                                type="number" 
                                id="max_team_members" 
                                name="max_team_members" 
                                value="<?php echo e(old('max_team_members', 5)); ?>"
                                min="1"
                                required
                                class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-cb-green"
                            >
                            <?php $__errorArgs = ['max_team_members'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <label for="rules" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-list-check text-cb-green mr-2"></i>
                            Reglas del Concurso
                        </label>
                        <textarea 
                            id="rules" 
                            name="rules" 
                            rows="4"
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Describe las reglas del concurso..."
                        ><?php echo e(old('rules')); ?></textarea>
                        <?php $__errorArgs = ['rules'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="mb-6">
                        <label for="requirements" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-clipboard-list text-cb-green mr-2"></i>
                            Requisitos
                        </label>
                        <textarea 
                            id="requirements" 
                            name="requirements" 
                            rows="4"
                            class="w-full px-4 py-3 bg-cb-dark border border-cb-border rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green"
                            placeholder="Describe los requisitos para participar..."
                        ><?php echo e(old('requirements')); ?></textarea>
                        <?php $__errorArgs = ['requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="flex gap-4">
                        <button 
                            type="submit"
                            class="flex-1 py-3 bg-cb-green hover:bg-green-600 text-cb-dark font-bold rounded-lg transition duration-300"
                        >
                            <i class="fas fa-check mr-2"></i>
                            Crear Concurso
                        </button>
                        <a 
                            href="<?php echo e(route('admin.contests.index')); ?>"
                            class="flex-1 py-3 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg transition duration-300 text-center"
                        >
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
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
<?php endif; ?>
<?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/admin/contests/create.blade.php ENDPATH**/ ?>