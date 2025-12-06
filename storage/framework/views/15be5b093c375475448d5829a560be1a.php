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
                <i class="fas fa-trophy text-cb-green mr-2"></i>
                <?php echo e($contest->name); ?>

            </h2>
            <a href="<?php echo e(route('welcome')); ?>#concursos" class="px-4 py-2 bg-cb-border text-white font-bold rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
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

            
            <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl shadow-xl p-8">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                <?php if($contest->status == 'Activo'): ?> bg-cb-green/20 text-cb-green border border-cb-green
                                <?php elseif($contest->status == 'Próximamente'): ?> bg-blue-900/40 text-blue-300 border border-blue-600
                                <?php else: ?> bg-gray-600/40 text-gray-300 border border-gray-500
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
                        <h1 class="text-4xl font-bold text-white mb-4"><?php echo e($contest->name); ?></h1>
                        <p class="text-gray-300 text-lg mb-6"><?php echo e($contest->description); ?></p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-cb-dark/50 p-4 rounded-lg">
                        <i class="fas fa-calendar text-cb-green text-2xl mb-2"></i>
                        <p class="text-gray-400 text-sm">Fecha de Inicio</p>
                        <p class="text-white font-bold"><?php echo e($contest->start_date->format('d M Y')); ?></p>
                    </div>
                    <div class="bg-cb-dark/50 p-4 rounded-lg">
                        <i class="fas fa-clock text-cb-green text-2xl mb-2"></i>
                        <p class="text-gray-400 text-sm">Duración</p>
                        <p class="text-white font-bold"><?php echo e($contest->duration); ?></p>
                    </div>
                    <div class="bg-cb-dark/50 p-4 rounded-lg">
                        <i class="fas fa-users text-cb-green text-2xl mb-2"></i>
                        <p class="text-gray-400 text-sm">Participantes</p>
                        <p class="text-white font-bold"><?php echo e($contest->participants); ?> personas</p>
                    </div>
                    <div class="bg-cb-dark/50 p-4 rounded-lg">
                        <i class="fas fa-trophy text-cb-green text-2xl mb-2"></i>
                        <p class="text-gray-400 text-sm">Premio</p>
                        <p class="text-white font-bold">$<?php echo e(number_format($contest->prize, 0)); ?></p>
                    </div>
                </div>
            </div>

            
            <?php if($contest->languages && is_array($contest->languages) && count($contest->languages) > 0): ?>
                <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-6">
                    <h3 class="text-xl font-bold text-white mb-4">
                        <i class="fas fa-code text-cb-green mr-2"></i>
                        Lenguajes Soportados
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <?php $__currentLoopData = $contest->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="px-4 py-2 bg-cb-green/10 text-cb-green border border-cb-green/30 rounded-lg font-medium">
                                <?php echo e($language); ?>

                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="grid md:grid-cols-3 gap-6">
                <a href="<?php echo e(route('teams.public', $contest->id)); ?>" class="bg-cb-card border-2 border-cb-border hover:border-cb-green rounded-xl p-6 transition group text-center">
                    <i class="fas fa-globe text-4xl text-cb-green mb-3"></i>
                    <h4 class="text-white font-bold mb-2">Ver Equipos Públicos</h4>
                    <p class="text-gray-400 text-sm">Únete a un equipo existente</p>
                </a>

                <div class="bg-cb-card border-2 border-cb-border hover:border-cb-green rounded-xl p-6 transition group text-center cursor-pointer" onclick="document.getElementById('buscar-equipo').scrollIntoView({behavior: 'smooth'})">
                    <i class="fas fa-search text-4xl text-cb-green mb-3"></i>
                    <h4 class="text-white font-bold mb-2">Buscar por Código</h4>
                    <p class="text-gray-400 text-sm">Tengo un código de equipo</p>
                </div>

                <div class="bg-cb-card border-2 border-cb-border hover:border-cb-green rounded-xl p-6 transition group text-center cursor-pointer" onclick="document.getElementById('registrar-equipo').scrollIntoView({behavior: 'smooth'})">
                    <i class="fas fa-plus-circle text-4xl text-cb-green mb-3"></i>
                    <h4 class="text-white font-bold mb-2">Crear Equipo Nuevo</h4>
                    <p class="text-gray-400 text-sm">Sé el líder de tu equipo</p>
                </div>
            </div>

            
            <div id="buscar-equipo" class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl shadow-xl p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-cb-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-3xl text-cb-green"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">¿Te Invitaron a un Equipo?</h3>
                    <p class="text-gray-400">Ingresa el código de 5 dígitos que te compartieron</p>
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
                </form>
            </div>

            
            <div id="registrar-equipo" class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8">
                <h3 class="text-2xl font-bold text-white mb-6">
                    <i class="fas fa-user-plus text-cb-green mr-2"></i>
                    Crear y Registrar Equipo
                </h3>

                <form method="POST" action="<?php echo e(route('contests.register', $contest->id)); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    
                    <div>
                        <label class="block text-gray-300 font-medium mb-2">Nombre del Equipo *</label>
                        <input type="text" name="team_name" required
                            class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition"
                            placeholder="Ej: Los Programadores">
                        <?php $__errorArgs = ['team_name'];
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
                        <label class="block text-gray-300 font-medium mb-2">Máximo de Miembros *</label>
                        <select name="max_members" required
                            class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-3 text-white focus:border-cb-green focus:ring focus:ring-cb-green/20 transition">
                            <option value="1">Solo yo (Individual)</option>
                            <option value="2">2 miembros</option>
                            <option value="3">3 miembros</option>
                            <option value="4">4 miembros</option>
                            <option value="5" selected>5 miembros</option>
                            <option value="6">6 miembros</option>
                            <option value="7">7 miembros</option>
                            <option value="8">8 miembros</option>
                            <option value="9">9 miembros</option>
                            <option value="10">10 miembros</option>
                        </select>
                        <?php $__errorArgs = ['max_members'];
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
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="is_public" value="1"
                                class="w-5 h-5 bg-cb-dark border-cb-border rounded text-cb-green focus:ring-cb-green focus:ring-offset-cb-card">
                            <div>
                                <span class="text-white font-medium">Equipo Público</span>
                                <p class="text-gray-400 text-sm">Cualquiera puede ver y unirse a tu equipo</p>
                            </div>
                        </label>
                    </div>

                    
                    <div class="bg-blue-500/10 border border-blue-500 rounded-lg p-4">
                        <h4 class="text-blue-400 font-bold mb-2 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Sobre el Código de Equipo
                        </h4>
                        <ul class="space-y-1 text-gray-300 text-sm">
                            <li>• Se generará un código único de 5 dígitos para tu equipo</li>
                            <li>• Comparte este código con tus compañeros para que se unan</li>
                            <li>• El código es sensible a mayúsculas y minúsculas</li>
                        </ul>
                    </div>

                    
                    <button type="submit" class="w-full bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-6 rounded-lg transition text-lg">
                        <i class="fas fa-check-circle mr-2"></i>
                        Crear Equipo y Registrarse
                    </button>
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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/contests/show.blade.php ENDPATH**/ ?>