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

            {{-- Filtros de categoría --}}
            <div class="flex flex-wrap gap-3">
                @foreach($categories as $category)
                    <a href="{{ route('blog.index', ['category' => $category['name']]) }}" 
                    class="px-4 py-2 rounded-lg font-medium transition border
                            @if($selectedCategory === $category['name'])
                                @if($category['name'] === 'Todos')
                                    bg-cb-green text-cb-dark border-cb-green
                                @elseif($category['name'] === 'Algoritmos')
                                    bg-blue-500 text-white border-blue-500
                                @elseif($category['name'] === 'Estructuras de Datos')
                                    bg-cyan-500 text-white border-cyan-500
                                @elseif($category['name'] === 'Competencias')
                                    bg-yellow-500 text-cb-dark border-yellow-500
                                @else
                                    bg-green-500 text-cb-dark border-green-500
                                @endif
                            @else
                                @if($category['name'] === 'Todos')
                                    bg-cb-green/10 hover:bg-cb-green/20 text-cb-green border-cb-green/30
                                @elseif($category['name'] === 'Algoritmos')
                                    bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border-blue-500/30
                                @elseif($category['name'] === 'Estructuras de Datos')
                                    bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 border-cyan-500/30
                                @elseif($category['name'] === 'Competencias')
                                    bg-yellow-500/10 hover:bg-yellow-500/20 text-yellow-400 border-yellow-500/30
                                @else
                                    bg-green-500/10 hover:bg-green-500/20 text-green-400 border-green-500/30
                                @endif
                            @endif
                       ">
                        {{ $category['name'] }} ({{ $category['count'] }})
                    </a>
                @endforeach
            </div>

            {{-- Grid de artículos --}}
            @if($posts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <div class="bg-cb-card rounded-xl shadow-xl border border-cb-border hover:border-cb-green/50 transition duration-300 overflow-hidden group">
                            {{-- Header con categoría y estadísticas --}}
                            <div class="bg-gradient-to-br from-cb-green/10 to-cb-dark h-32 flex flex-col items-center justify-center group-hover:from-cb-green/20 transition p-4">
                                <div class="text-5xl mb-2">
                                    @if($post->category === 'Algoritmos')
                                        💻
                                    @elseif($post->category === 'Estructuras de Datos')
                                        🧩
                                    @elseif($post->category === 'Competencias')
                                        🏆
                                    @else
                                        ⚡
                                    @endif
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border 
                                    @if($post->category === 'Algoritmos')
                                        bg-blue-500/20 text-blue-400 border-blue-500
                                    @elseif($post->category === 'Estructuras de Datos')
                                        bg-cyan-500/20 text-cyan-400 border-cyan-500
                                    @elseif($post->category === 'Competencias')
                                        bg-yellow-500/20 text-yellow-400 border-yellow-500
                                    @else
                                        bg-green-500/20 text-green-400 border-green-500
                                    @endif
                                ">
                                    {{ $post->category }}
                                </span>
                            </div>

                            {{-- Contenido --}}
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between text-xs text-gray-400">
                                    <span class="flex items-center">
                                        <i class="far fa-eye mr-1"></i>
                                        {{ number_format($post->views_count) }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-heart mr-1"></i>
                                        {{ $post->likes_count }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $post->published_at->format('d M') }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-white group-hover:text-cb-green transition line-clamp-2 min-h-[3.5rem]">
                                    {{ $post->title }}
                                </h3>

                                <p class="text-gray-400 text-sm line-clamp-3 min-h-[4.5rem]">
                                    {{ $post->excerpt }}
                                </p>

                                <div class="flex items-center space-x-3 pt-4 border-t border-cb-border">
                                    <div class="w-8 h-8 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($post->author->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-medium text-sm truncate">{{ $post->author->name }}</p>
                                        <p class="text-xs text-gray-400">
                                            {{ $post->published_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <a href="{{ route('blog.show', $post->slug) }}" class="block w-full bg-cb-green/10 hover:bg-cb-green/20 text-cb-green font-semibold py-3 rounded-lg transition group-hover:bg-cb-green group-hover:text-cb-dark text-center">
                                    Leer más →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginación --}}
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="bg-cb-card border border-cb-border rounded-xl p-12 text-center">
                    <i class="fas fa-inbox text-6xl text-gray-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">No hay artículos en esta categoría</h3>
                    <p class="text-gray-400 mb-6">Intenta seleccionar otra categoría o vuelve más tarde</p>
                    <a href="{{ route('blog.index') }}" class="inline-block bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                        Ver todos los artículos
                    </a>
                </div>
            @endif

            {{-- CTA final --}}
            <div class="bg-gradient-to-r from-cb-green/10 to-cb-card border border-cb-green/30 rounded-xl p-8 text-center">
                <i class="fas fa-pen-nib text-5xl text-cb-green mb-4"></i>
                <h3 class="text-2xl font-bold text-white mb-4">¿Tienes algo que compartir?</h3>
                <p class="text-gray-400 mb-6 max-w-2xl mx-auto">
                    Comparte tus conocimientos y experiencias con la comunidad CodeBattle
                </p>
                @auth
                    @hasanyrole('admin|super_admin')
                        <a href="{{ route('blog.create') }}" class="inline-block bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Escribir Artículo
                        </a>
                    @else
                        <button onclick="alert('Solo los administradores pueden crear artículos. Contacta a un admin si deseas contribuir.')" class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-3 px-8 rounded-lg transition">
                            <i class="fas fa-lock mr-2"></i>
                            Escribir Artículo
                        </button>
                    @endhasanyrole
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Inicia sesión para contribuir
                    </a>
                @endauth
            </div>

        </div>
    </div>
</x-app-layout>
