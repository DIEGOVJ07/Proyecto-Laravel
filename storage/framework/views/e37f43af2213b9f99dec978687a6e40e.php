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
                <i class="fas fa-edit text-cb-green mr-2"></i>
                Editar Juez: <?php echo e($judge->name); ?>

            </h2>
            <a href="<?php echo e(route('admin.judges.index')); ?>" class="px-4 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <form method="POST" action="<?php echo e(route('admin.judges.update', $judge)); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    
                    <div class="border-b border-cb-border pb-6">
                        <h3 class="text-xl font-bold text-white mb-4">
                            <i class="fas fa-user mr-2 text-cb-green"></i>
                            Información Personal
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Nombre Completo *</label>
                                <input type="text" name="name" value="<?php echo e(old('name', $judge->name)); ?>" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
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

                            
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Correo Electrónico *</label>
                                <input type="email" name="email" value="<?php echo e(old('email', $judge->email)); ?>" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                <?php $__errorArgs = ['email'];
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
                                <label class="block text-gray-300 font-medium mb-2">Teléfono</label>
                                <input type="text" name="phone" value="<?php echo e(old('phone', $judge->phone)); ?>"
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                <?php $__errorArgs = ['phone'];
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
                                <label class="block text-gray-300 font-medium mb-2">Institución/Empresa</label>
                                <input type="text" name="institution" value="<?php echo e(old('institution', $judge->institution)); ?>"
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                <?php $__errorArgs = ['institution'];
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
                    </div>

                    
                    <div class="border-b border-cb-border pb-6">
                        <h3 class="text-xl font-bold text-white mb-4">
                            <i class="fas fa-briefcase mr-2 text-cb-green"></i>
                            Información Profesional
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-gray-300 font-medium mb-2">Especialidad *</label>
                                <select name="specialty" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                    <option value="">Seleccionar...</option>
                                    <option value="Algoritmos" <?php echo e(old('specialty', $judge->specialty) == 'Algoritmos' ? 'selected' : ''); ?>>Algoritmos</option>
                                    <option value="Estructuras de Datos" <?php echo e(old('specialty', $judge->specialty) == 'Estructuras de Datos' ? 'selected' : ''); ?>>Estructuras de Datos</option>
                                    <option value="Programación Dinámica" <?php echo e(old('specialty', $judge->specialty) == 'Programación Dinámica' ? 'selected' : ''); ?>>Programación Dinámica</option>
                                    <option value="Grafos" <?php echo e(old('specialty', $judge->specialty) == 'Grafos' ? 'selected' : ''); ?>>Grafos</option>
                                    <option value="Matemáticas" <?php echo e(old('specialty', $judge->specialty) == 'Matemáticas' ? 'selected' : ''); ?>>Matemáticas</option>
                                    <option value="Inteligencia Artificial" <?php echo e(old('specialty', $judge->specialty) == 'Inteligencia Artificial' ? 'selected' : ''); ?>>Inteligencia Artificial</option>
                                    <option value="Bases de Datos" <?php echo e(old('specialty', $judge->specialty) == 'Bases de Datos' ? 'selected' : ''); ?>>Bases de Datos</option>
                                    <option value="Desarrollo Web" <?php echo e(old('specialty', $judge->specialty) == 'Desarrollo Web' ? 'selected' : ''); ?>>Desarrollo Web</option>
                                </select>
                                <?php $__errorArgs = ['specialty'];
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
                                <label class="block text-gray-300 font-medium mb-2">Nivel de Certificación *</label>
                                <select name="certification_level" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                    <option value="">Seleccionar...</option>
                                    <option value="Junior" <?php echo e(old('certification_level', $judge->certification_level) == 'Junior' ? 'selected' : ''); ?>>🎯 Junior</option>
                                    <option value="Senior" <?php echo e(old('certification_level', $judge->certification_level) == 'Senior' ? 'selected' : ''); ?>>⭐ Senior</option>
                                    <option value="Expert" <?php echo e(old('certification_level', $judge->certification_level) == 'Expert' ? 'selected' : ''); ?>>🏆 Expert</option>
                                </select>
                                <?php $__errorArgs = ['certification_level'];
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
                                <label class="block text-gray-300 font-medium mb-2">Años de Experiencia *</label>
                                <input type="number" name="experience_years" value="<?php echo e(old('experience_years', $judge->experience_years)); ?>" min="0" required
                                    class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                                <?php $__errorArgs = ['experience_years'];
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

                            
                            <div class="flex items-center">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $judge->is_active) ? 'checked' : ''); ?>

                                        class="w-5 h-5 bg-cb-dark border-cb-border rounded text-cb-green focus:ring-cb-green focus:ring-offset-cb-card">
                                    <span class="text-gray-300 font-medium">Juez Activo</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-gray-300 font-medium mb-2">Biografía/Experiencia</label>
                        <textarea name="bio" rows="4"
                            class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition"
                            placeholder="Describe la experiencia y logros del juez..."><?php echo e(old('bio', $judge->bio)); ?></textarea>
                        <?php $__errorArgs = ['bio'];
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

                    
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-cb-border">
                        <a href="<?php echo e(route('admin.judges.index')); ?>" class="px-6 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                            Cancelar
                        </a>
                        <button type="submit" class="px-6 py-2 bg-cb-green text-cb-dark font-bold rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-save mr-2"></i>
                            Actualizar Juez
                        </button>
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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/admin/judges/edit.blade.php ENDPATH**/ ?>