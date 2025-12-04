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
            <i class="fas fa-blog text-cb-green mr-2"></i>
            Blog CodeBattle
        </h2>
        <p class="text-gray-400 text-sm mt-1">Artículos, tutoriales y recursos para mejorar tus habilidades</p>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            
            <?php if($featuredPost): ?>
                <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border-2 border-cb-green rounded-xl overflow-hidden hover:border-cb-green/70 transition duration-300 shadow-2xl">
                    <div class="md:flex">
                        <div class="md:w-1/3 bg-gradient-to-br from-cb-green/20 to-cb-card flex items-center justify-center p-12">
                            <div class="text-9xl"><?php echo e($featuredPost['image']); ?></div>
                        </div>
                        <div class="md:w-2/3 p-8">
                            <div class="flex items-center space-x-3 mb-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500">
                                    ⭐ DESTACADO
                                </span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border <?php echo e($featuredPost['category_color']); ?>">
                                    <?php echo e($featuredPost['category']); ?>

                                </span>
                            </div>
                            
                            <h2 class="text-3xl font-bold text-white mb-4 hover:text-cb-green transition">
                                <?php echo e($featuredPost['title']); ?>

                            </h2>
                            
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                <?php echo e($featuredPost['excerpt']); ?>

                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                                            <?php echo e($featuredPost['author_avatar']); ?>

                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm"><?php echo e($featuredPost['author']); ?></p>
                                            <div class="flex items-center space-x-3 text-xs text-gray-400">
                                                <span class="flex items-center">
                                                    <i class="far fa-calendar mr-1"></i>
                                                    <?php echo e($featuredPost['date']); ?>

                                                </span>
                                                <span class="flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    <?php echo e($featuredPost['read_time']); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-gray-400">
                                    <span class="flex items-center space-x-1">
                                        <i class="far fa-eye"></i>
                                        <span><?php echo e(number_format($featuredPost['views'])); ?></span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <i class="far fa-heart"></i>
                                        <span><?php echo e($featuredPost['likes']); ?></span>
                                    </span>
                                </div>
                            </div>

                            <button onclick="showPost<?php echo e($featuredPost['id']); ?>.showModal()" class="mt-6 bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition inline-flex items-center space-x-2">
                                <i class="fas fa-book-open"></i>
                                <span>Leer Artículo Completo</span>
                            </button>
                        </div>
                    </div>
                </div>

                
                <dialog id="showPost<?php echo e($featuredPost['id']); ?>" class="rounded-xl bg-cb-card border border-cb-border p-0 backdrop:bg-black/80 max-w-4xl w-full">
                    <div class="max-h-[80vh] overflow-y-auto">
                        
                        <div class="sticky top-0 bg-cb-card border-b border-cb-border p-6 flex items-center justify-between z-10">
                            <div class="flex items-center space-x-3">
                                <div class="text-4xl"><?php echo e($featuredPost['image']); ?></div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white"><?php echo e($featuredPost['title']); ?></h3>
                                    <p class="text-gray-400 text-sm">Por <?php echo e($featuredPost['author']); ?></p>
                                </div>
                            </div>
                            <button onclick="showPost<?php echo e($featuredPost['id']); ?>.close()" class="text-gray-400 hover:text-white transition">
                                <i class="fas fa-times text-2xl"></i>
                            </button>
                        </div>

                        
                        <div class="p-8">
                            <div class="prose prose-invert max-w-none">
                                <p class="text-gray-300 text-lg leading-relaxed mb-6"><?php echo e($featuredPost['content']); ?></p>
                                
                                <div class="bg-cb-dark/50 border border-cb-border rounded-lg p-6 mb-6">
                                    <h4 class="text-white font-bold mb-3 flex items-center">
                                        <i class="fas fa-lightbulb text-yellow-400 mr-2"></i>
                                        Puntos Clave
                                    </h4>
                                    <ul class="space-y-2 text-gray-300">
                                        <li class="flex items-start">
                                            <i class="fas fa-check text-cb-green mr-2 mt-1"></i>
                                            <span>Comprende los conceptos fundamentales antes de resolver problemas</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check text-cb-green mr-2 mt-1"></i>
                                            <span>Practica con problemas de diferentes niveles de dificultad</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-check text-cb-green mr-2 mt-1"></i>
                                            <span>Analiza las soluciones de otros competidores</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-cb-border">
                                    <div class="flex items-center space-x-4">
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg transition">
                                            <i class="far fa-heart"></i>
                                            <span><?php echo e($featuredPost['likes']); ?></span>
                                        </button>
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 rounded-lg transition">
                                            <i class="fas fa-share-alt"></i>
                                            <span>Compartir</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </dialog>
            <?php endif; ?>

            
            <div class="flex flex-wrap gap-3">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="px-4 py-2 rounded-lg font-medium transition <?php echo e($category['color']); ?>/10 hover:<?php echo e($category['color']); ?>/20 text-white border border-<?php echo e($category['color']); ?>">
                        <?php echo e($category['name']); ?> (<?php echo e($category['count']); ?>)
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition duration-300 overflow-hidden group">
                        
                        <div class="bg-gradient-to-br from-cb-green/10 to-cb-dark h-48 flex items-center justify-center group-hover:from-cb-green/20 transition">
                            <div class="text-7xl"><?php echo e($post['image']); ?></div>
                        </div>

                        
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border <?php echo e($post['category_color']); ?>">
                                    <?php echo e($post['category']); ?>

                                </span>
                                <div class="flex items-center space-x-3 text-xs text-gray-400">
                                    <span class="flex items-center">
                                        <i class="far fa-eye mr-1"></i>
                                        <?php echo e(number_format($post['views'])); ?>

                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-heart mr-1"></i>
                                        <?php echo e($post['likes']); ?>

                                    </span>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-white group-hover:text-cb-green transition line-clamp-2">
                                <?php echo e($post['title']); ?>

                            </h3>

                            <p class="text-gray-400 text-sm line-clamp-3">
                                <?php echo e($post['excerpt']); ?>

                            </p>

                            <div class="flex items-center space-x-3 pt-4 border-t border-cb-border">
                                <div class="w-8 h-8 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    <?php echo e($post['author_avatar']); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-medium text-sm truncate"><?php echo e($post['author']); ?></p>
                                    <div class="flex items-center space-x-2 text-xs text-gray-400">
                                        <span><?php echo e($post['date']); ?></span>
                                        <span>•</span>
                                        <span><?php echo e($post['read_time']); ?></span>
                                    </div>
                                </div>
                            </div>

                            <button onclick="showPost<?php echo e($post['id']); ?>.showModal()" class="w-full bg-cb-green/10 hover:bg-cb-green/20 text-cb-green font-semibold py-3 rounded-lg transition group-hover:bg-cb-green group-hover:text-cb-dark">
                                Leer más →
                            </button>
                        </div>
                    </div>

                    
                    <dialog id="showPost<?php echo e($post['id']); ?>" class="rounded-xl bg-cb-card border border-cb-border p-0 backdrop:bg-black/80 max-w-4xl w-full">
                        <div class="max-h-[80vh] overflow-y-auto">
                            <div class="sticky top-0 bg-cb-card border-b border-cb-border p-6 flex items-center justify-between z-10">
                                <div class="flex items-center space-x-3">
                                    <div class="text-4xl"><?php echo e($post['image']); ?></div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-white"><?php echo e($post['title']); ?></h3>
                                        <p class="text-gray-400 text-sm">Por <?php echo e($post['author']); ?></p>
                                    </div>
                                </div>
                                <button onclick="showPost<?php echo e($post['id']); ?>.close()" class="text-gray-400 hover:text-white transition">
                                    <i class="fas fa-times text-2xl"></i>
                                </button>
                            </div>

                            <div class="p-8">
                                <p class="text-gray-300 text-lg leading-relaxed"><?php echo e($post['content']); ?></p>
                                
                                <div class="flex items-center justify-between pt-6 border-t border-cb-border mt-6">
                                    <div class="flex items-center space-x-4">
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg transition">
                                            <i class="far fa-heart"></i>
                                            <span><?php echo e($post['likes']); ?></span>
                                        </button>
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 rounded-lg transition">
                                            <i class="fas fa-share-alt"></i>
                                            <span>Compartir</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dialog>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl p-8 text-center">
                <i class="fas fa-pen-nib text-5xl text-cb-green mb-4"></i>
                <h3 class="text-2xl font-bold text-white mb-4">¿Tienes algo que compartir?</h3>
                <p class="text-gray-400 mb-6 max-w-2xl mx-auto">
                    Comparte tus conocimientos y experiencias con la comunidad CodeBattle
                </p>
                <button class="bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Escribir Artículo
                </button>
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
<?php endif; ?><?php /**PATH C:\Users\samue\OneDrive\Escritorio\Programacion web\PROYECTO\resources\views/blog/index.blade.php ENDPATH**/ ?>