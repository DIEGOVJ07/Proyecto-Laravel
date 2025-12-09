<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Header del artículo --}}
            <article class="bg-cb-card rounded-xl shadow-2xl border border-cb-border overflow-hidden">
                {{-- Hero section --}}
                <div class="bg-gradient-to-br from-cb-green/20 via-cb-dark to-cb-card p-12 text-center border-b border-cb-border">
                    <div class="text-7xl mb-6">
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
                    <span class="px-4 py-2 text-sm font-semibold rounded-full border inline-block mb-4
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
                    <h1 class="text-4xl font-bold text-white mb-4">{{ $post->title }}</h1>
                    <p class="text-xl text-gray-300 mb-6">{{ $post->excerpt }}</p>
                    
                    {{-- Autor y metadatos --}}
                    <div class="flex items-center justify-center space-x-6 text-sm text-gray-400">
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-cb-green to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($post->author->name, 0, 1)) }}
                            </div>
                            <div class="text-left">
                                <p class="text-white font-semibold">{{ $post->author->name }}</p>
                                <p class="text-xs">{{ $post->published_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <span class="flex items-center">
                            <i class="far fa-clock mr-1"></i>
                            {{ $post->published_at->diffForHumans() }}
                        </span>
                        <span class="flex items-center">
                            <i class="far fa-eye mr-1"></i>
                            {{ number_format($post->views_count) }} vistas
                        </span>
                    </div>
                </div>

                {{-- Contenido del artículo --}}
                <div class="p-8 md:p-12">
                    <div class="article-content text-gray-200">
                        {!! $post->content !!}
                    </div>
                </div>

                <style>
                    .article-content {
                        line-height: 1.8;
                        color: #D1D5DB; /* gray-300 */
                    }
                    
                    .article-content h2 {
                        color: #10B981; /* cb-green */
                        font-size: 1.875rem;
                        font-weight: 700;
                        margin-top: 2rem;
                        margin-bottom: 1rem;
                    }
                    
                    .article-content h3 {
                        color: #FFFFFF;
                        font-size: 1.5rem;
                        font-weight: 600;
                        margin-top: 1.5rem;
                        margin-bottom: 0.75rem;
                    }
                    
                    .article-content h4 {
                        color: #E5E7EB; /* gray-200 */
                        font-size: 1.25rem;
                        font-weight: 600;
                        margin-top: 1.25rem;
                        margin-bottom: 0.5rem;
                    }
                    
                    .article-content p {
                        color: #D1D5DB; /* gray-300 */
                        margin-bottom: 1rem;
                        line-height: 1.75;
                    }
                    
                    .article-content strong {
                        color: #FFFFFF;
                        font-weight: 700;
                    }
                    
                    .article-content em {
                        color: #D1D5DB;
                        font-style: italic;
                    }
                    
                    .article-content ul,
                    .article-content ol {
                        color: #D1D5DB;
                        margin-left: 1.5rem;
                        margin-bottom: 1rem;
                    }
                    
                    .article-content ul {
                        list-style-type: disc;
                    }
                    
                    .article-content ol {
                        list-style-type: decimal;
                    }
                    
                    .article-content li {
                        color: #D1D5DB;
                        margin-bottom: 0.5rem;
                        line-height: 1.6;
                    }
                    
                    .article-content a {
                        color: #10B981;
                        text-decoration: underline;
                    }
                    
                    .article-content a:hover {
                        color: #34D399;
                    }
                    
                    .article-content code {
                        background-color: #0D1421; /* cb-dark */
                        color: #10B981;
                        padding: 0.125rem 0.375rem;
                        border-radius: 0.25rem;
                        font-size: 0.875rem;
                        font-family: monospace;
                    }
                    
                    .article-content pre {
                        background-color: #0D1421;
                        border: 1px solid #29374D;
                        border-radius: 0.5rem;
                        padding: 1rem;
                        overflow-x: auto;
                        margin: 1rem 0;
                    }
                    
                    .article-content pre code {
                        background-color: transparent;
                        padding: 0;
                        color: #D1D5DB;
                    }
                    
                    .article-content blockquote {
                        border-left: 4px solid #10B981;
                        padding-left: 1rem;
                        color: #9CA3AF;
                        font-style: italic;
                        margin: 1rem 0;
                    }
                    
                    .article-content table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 1rem 0;
                        color: #D1D5DB;
                    }
                    
                    .article-content thead {
                        border-bottom: 2px solid #29374D;
                    }
                    
                    .article-content th {
                        color: #FFFFFF;
                        font-weight: 600;
                        padding: 0.75rem;
                        text-align: left;
                    }
                    
                    .article-content tr {
                        border-bottom: 1px solid rgba(41, 55, 77, 0.5);
                    }
                    
                    .article-content td {
                        color: #D1D5DB;
                        padding: 0.75rem;
                    }
                </style>

                {{-- Acciones (Like y Compartir) --}}
                <div class="border-t border-cb-border p-6 bg-cb-dark/30">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @auth
                                <button 
                                    id="likeButton"
                                    data-post-id="{{ $post->id }}"
                                    class="flex items-center space-x-2 px-6 py-3 rounded-lg transition font-semibold
                                           {{ $userLiked ? 'bg-red-500/20 text-red-400 hover:bg-red-500/30 border border-red-500/30' : 'bg-cb-card text-gray-300 hover:bg-cb-green hover:text-cb-dark border border-cb-border hover:border-cb-green' }}">
                                    <i class="{{ $userLiked ? 'fas' : 'far' }} fa-heart"></i>
                                    <span id="likesCount">{{ $post->likes_count }}</span>
                                    <span>{{ $userLiked ? 'Te gusta' : 'Me gusta' }}</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="flex items-center space-x-2 px-6 py-3 bg-cb-card text-gray-300 hover:bg-cb-green hover:text-cb-dark border border-cb-border hover:border-cb-green rounded-lg transition font-semibold">
                                    <i class="far fa-heart"></i>
                                    <span>{{ $post->likes_count }}</span>
                                    <span>Me gusta</span>
                                </a>
                            @endauth
                            
                            <button 
                                onclick="if(navigator.share){navigator.share({title:'{{ $post->title }}',text:'{{ $post->excerpt }}',url:window.location.href}).catch(()=>{})}else{alert('Función de compartir no disponible en este navegador')}" 
                                class="flex items-center space-x-2 px-6 py-3 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/30 hover:border-blue-500 rounded-lg transition font-semibold">
                                <i class="fas fa-share-alt"></i>
                                <span>Compartir</span>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            {{-- Artículos relacionados --}}
            @if($relatedPosts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-book text-cb-green mr-3"></i>
                        Artículos Relacionados
                    </h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach($relatedPosts as $related)
                            <a href="{{ route('blog.show', $related->slug) }}" class="bg-cb-card rounded-xl border border-cb-border hover:border-cb-green/50 transition overflow-hidden group">
                                <div class="bg-gradient-to-br from-cb-green/10 to-cb-dark h-24 flex items-center justify-center group-hover:from-cb-green/20 transition">
                                    <div class="text-4xl">
                                        @if($related->category === 'Algoritmos')
                                            💻
                                        @elseif($related->category === 'Estructuras de Datos')
                                            🧩
                                        @elseif($related->category === 'Competencias')
                                            🏆
                                        @else
                                            ⚡
                                        @endif
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-white font-bold group-hover:text-cb-green transition line-clamp-2 mb-2">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-gray-400 text-sm line-clamp-2">
                                        {{ $related->excerpt }}
                                    </p>
                                    <div class="flex items-center justify-between mt-3 text-xs text-gray-500">
                                        <span class="flex items-center">
                                            <i class="far fa-eye mr-1"></i>
                                            {{ number_format($related->views_count) }}
                                        </span>
                                        <span>{{ $related->published_at->format('d M') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Botón volver --}}
            <div class="mt-8 text-center">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center space-x-2 text-cb-green hover:text-green-400 transition font-semibold">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver al Blog</span>
                </a>
            </div>
        </div>
    </div>

    @auth
    <script>
        document.getElementById('likeButton')?.addEventListener('click', async function() {
            const button = this;
            const postId = button.dataset.postId;
            const icon = button.querySelector('i');
            const count = document.getElementById('likesCount');
            const text = button.querySelector('span:last-child');
            
            button.disabled = true;
            
            try {
                const response = await fetch(`/blog/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    count.textContent = data.likes_count;
                    
                    if (data.liked) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        button.classList.remove('bg-cb-card', 'text-gray-300', 'hover:bg-cb-green', 'hover:text-cb-dark', 'border-cb-border', 'hover:border-cb-green');
                        button.classList.add('bg-red-500/20', 'text-red-400', 'hover:bg-red-500/30', 'border-red-500/30');
                        text.textContent = 'Te gusta';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        button.classList.remove('bg-red-500/20', 'text-red-400', 'hover:bg-red-500/30', 'border-red-500/30');
                        button.classList.add('bg-cb-card', 'text-gray-300', 'hover:bg-cb-green', 'hover:text-cb-dark', 'border-cb-border', 'hover:border-cb-green');
                        text.textContent = 'Me gusta';
                    }
                }
            } catch (error) {
                console.error('Error al dar like:', error);
            } finally {
                button.disabled = false;
            }
        });
    </script>
    @endauth
</x-app-layout>
