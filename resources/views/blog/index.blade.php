<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-blog text-cb-green mr-2"></i>
            Blog CodeBattle
        </h2>
        <p class="text-gray-400 text-sm mt-1">Artículos, tutoriales y recursos para mejorar tus habilidades</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Artículo Destacado --}}
            @if($featuredPost)
                <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border-2 border-cb-green rounded-xl overflow-hidden hover:border-cb-green/70 transition duration-300 shadow-2xl">
                    <div class="md:flex">
                        <div class="md:w-1/3 bg-gradient-to-br from-cb-green/20 to-cb-card flex items-center justify-center p-12">
                            <div class="text-9xl">{{ $featuredPost['image'] }}</div>
                        </div>
                        <div class="md:w-2/3 p-8">
                            <div class="flex items-center space-x-3 mb-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500">
                                    ⭐ DESTACADO
                                </span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $featuredPost['category_color'] }}">
                                    {{ $featuredPost['category'] }}
                                </span>
                            </div>
                            
                            <h2 class="text-3xl font-bold text-white mb-4 hover:text-cb-green transition">
                                {{ $featuredPost['title'] }}
                            </h2>
                            
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                {{ $featuredPost['excerpt'] }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ $featuredPost['author_avatar'] }}
                                        </div>
                                        <div>
                                            <p class="text-white font-medium text-sm">{{ $featuredPost['author'] }}</p>
                                            <div class="flex items-center space-x-3 text-xs text-gray-400">
                                                <span class="flex items-center">
                                                    <i class="far fa-calendar mr-1"></i>
                                                    {{ $featuredPost['date'] }}
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="far fa-clock mr-1"></i>
                                                    {{ $featuredPost['read_time'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-gray-400">
                                    <span class="flex items-center space-x-1">
                                        <i class="far fa-eye"></i>
                                        <span>{{ number_format($featuredPost['views']) }}</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <i class="far fa-heart"></i>
                                        <span>{{ $featuredPost['likes'] }}</span>
                                    </span>
                                </div>
                            </div>

                            <button onclick="showPost{{ $featuredPost['id'] }}.showModal()" class="mt-6 bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition inline-flex items-center space-x-2">
                                <i class="fas fa-book-open"></i>
                                <span>Leer Artículo Completo</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal del artículo destacado --}}
                <dialog id="showPost{{ $featuredPost['id'] }}" class="rounded-xl bg-cb-card border border-cb-border p-0 backdrop:bg-black/80 max-w-4xl w-full">
                    <div class="max-h-[80vh] overflow-y-auto">
                        {{-- Header --}}
                        <div class="sticky top-0 bg-cb-card border-b border-cb-border p-6 flex items-center justify-between z-10">
                            <div class="flex items-center space-x-3">
                                <div class="text-4xl">{{ $featuredPost['image'] }}</div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">{{ $featuredPost['title'] }}</h3>
                                    <p class="text-gray-400 text-sm">Por {{ $featuredPost['author'] }}</p>
                                </div>
                            </div>
                            <button onclick="showPost{{ $featuredPost['id'] }}.close()" class="text-gray-400 hover:text-white transition">
                                <i class="fas fa-times text-2xl"></i>
                            </button>
                        </div>

                        {{-- Contenido --}}
                        <div class="p-8">
                            <div class="prose prose-invert max-w-none">
                                <p class="text-gray-300 text-lg leading-relaxed mb-6">{{ $featuredPost['content'] }}</p>
                                
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
                                            <span>{{ $featuredPost['likes'] }}</span>
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
            @endif

            {{-- Filtros de categoría --}}
            <div class="flex flex-wrap gap-3">
                @foreach($categories as $category)
                    <button class="px-4 py-2 rounded-lg font-medium transition {{ $category['color'] }}/10 hover:{{ $category['color'] }}/20 text-white border border-{{ $category['color'] }}">
                        {{ $category['name'] }} ({{ $category['count'] }})
                    </button>
                @endforeach
            </div>

            {{-- Grid de artículos --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentPosts as $post)
                    <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition duration-300 overflow-hidden group">
                        {{-- Imagen/Icono --}}
                        <div class="bg-gradient-to-br from-cb-green/10 to-cb-dark h-48 flex items-center justify-center group-hover:from-cb-green/20 transition">
                            <div class="text-7xl">{{ $post['image'] }}</div>
                        </div>

                        {{-- Contenido --}}
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $post['category_color'] }}">
                                    {{ $post['category'] }}
                                </span>
                                <div class="flex items-center space-x-3 text-xs text-gray-400">
                                    <span class="flex items-center">
                                        <i class="far fa-eye mr-1"></i>
                                        {{ number_format($post['views']) }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-heart mr-1"></i>
                                        {{ $post['likes'] }}
                                    </span>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-white group-hover:text-cb-green transition line-clamp-2">
                                {{ $post['title'] }}
                            </h3>

                            <p class="text-gray-400 text-sm line-clamp-3">
                                {{ $post['excerpt'] }}
                            </p>

                            <div class="flex items-center space-x-3 pt-4 border-t border-cb-border">
                                <div class="w-8 h-8 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    {{ $post['author_avatar'] }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-medium text-sm truncate">{{ $post['author'] }}</p>
                                    <div class="flex items-center space-x-2 text-xs text-gray-400">
                                        <span>{{ $post['date'] }}</span>
                                        <span>•</span>
                                        <span>{{ $post['read_time'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <button onclick="showPost{{ $post['id'] }}.showModal()" class="w-full bg-cb-green/10 hover:bg-cb-green/20 text-cb-green font-semibold py-3 rounded-lg transition group-hover:bg-cb-green group-hover:text-cb-dark">
                                Leer más →
                            </button>
                        </div>
                    </div>

                    {{-- Modal para cada post --}}
                    <dialog id="showPost{{ $post['id'] }}" class="rounded-xl bg-cb-card border border-cb-border p-0 backdrop:bg-black/80 max-w-4xl w-full">
                        <div class="max-h-[80vh] overflow-y-auto">
                            <div class="sticky top-0 bg-cb-card border-b border-cb-border p-6 flex items-center justify-between z-10">
                                <div class="flex items-center space-x-3">
                                    <div class="text-4xl">{{ $post['image'] }}</div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-white">{{ $post['title'] }}</h3>
                                        <p class="text-gray-400 text-sm">Por {{ $post['author'] }}</p>
                                    </div>
                                </div>
                                <button onclick="showPost{{ $post['id'] }}.close()" class="text-gray-400 hover:text-white transition">
                                    <i class="fas fa-times text-2xl"></i>
                                </button>
                            </div>

                            <div class="p-8">
                                <p class="text-gray-300 text-lg leading-relaxed">{{ $post['content'] }}</p>
                                
                                <div class="flex items-center justify-between pt-6 border-t border-cb-border mt-6">
                                    <div class="flex items-center space-x-4">
                                        <button class="flex items-center space-x-2 px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg transition">
                                            <i class="far fa-heart"></i>
                                            <span>{{ $post['likes'] }}</span>
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
                @endforeach
            </div>

            {{-- CTA final --}}
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
</x-app-layout>