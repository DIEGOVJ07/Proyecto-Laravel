<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            <i class="fas fa-pen-nib text-cb-green mr-2"></i>
            Escribir Nuevo Artículo
        </h2>
        <p class="text-gray-400 text-sm mt-1">Comparte tus conocimientos con la comunidad CodeBattle</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('blog.store') }}" method="POST" class="bg-cb-card rounded-xl shadow-xl border border-cb-border p-8 space-y-6">
                @csrf

                {{-- Título --}}
                <div>
                    <label for="title" class="block text-white font-semibold mb-2">
                        <i class="fas fa-heading text-cb-green mr-2"></i>
                        Título del Artículo *
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}"
                        class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring focus:ring-cb-green/50 transition"
                        placeholder="Ej: Introducción a los Algoritmos de Grafos"
                        required
                        maxlength="255">
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Extracto --}}
                <div>
                    <label for="excerpt" class="block text-white font-semibold mb-2">
                        <i class="fas fa-align-left text-cb-green mr-2"></i>
                        Extracto / Resumen *
                    </label>
                    <textarea 
                        id="excerpt" 
                        name="excerpt" 
                        rows="3"
                        class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring focus:ring-cb-green/50 transition resize-none"
                        placeholder="Breve descripción que aparecerá en la lista de artículos (máx. 500 caracteres)"
                        required
                        maxlength="500">{{ old('excerpt') }}</textarea>
                    <p class="text-gray-400 text-sm mt-1">
                        <span id="excerptCount">0</span>/500 caracteres
                    </p>
                    @error('excerpt')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div>
                    <label for="category" class="block text-white font-semibold mb-2">
                        <i class="fas fa-tag text-cb-green mr-2"></i>
                        Categoría *
                    </label>
                    <select 
                        id="category" 
                        name="category"
                        class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring focus:ring-cb-green/50 transition"
                        required>
                        <option value="">Selecciona una categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contenido --}}
                <div>
                    <label for="content" class="block text-white font-semibold mb-2">
                        <i class="fas fa-file-alt text-cb-green mr-2"></i>
                        Contenido del Artículo *
                    </label>
                    <p class="text-gray-400 text-sm mb-2">
                        Puedes usar HTML básico para formato: &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;code&gt;, &lt;pre&gt;
                    </p>
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="20"
                        class="w-full bg-cb-dark border border-cb-border text-white rounded-lg px-4 py-3 focus:border-cb-green focus:ring focus:ring-cb-green/50 transition font-mono text-sm"
                        placeholder="<h2>Introducción</h2>&#10;<p>Escribe tu contenido aquí...</p>&#10;&#10;<h3>Sección 1</h3>&#10;<p>Más contenido...</p>"
                        required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Guía de formato --}}
                <div class="bg-cb-dark/50 border border-cb-border rounded-lg p-6">
                    <h3 class="text-white font-bold mb-3 flex items-center">
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Guía de Formato HTML
                    </h3>
                    <div class="grid md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-400 mb-2"><strong class="text-white">Títulos:</strong></p>
                            <code class="text-cb-green">&lt;h2&gt;Título Principal&lt;/h2&gt;</code><br>
                            <code class="text-cb-green">&lt;h3&gt;Subtítulo&lt;/h3&gt;</code>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-2"><strong class="text-white">Listas:</strong></p>
                            <code class="text-cb-green">&lt;ul&gt;&lt;li&gt;Item&lt;/li&gt;&lt;/ul&gt;</code>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-2"><strong class="text-white">Énfasis:</strong></p>
                            <code class="text-cb-green">&lt;strong&gt;Negrita&lt;/strong&gt;</code><br>
                            <code class="text-cb-green">&lt;em&gt;Cursiva&lt;/em&gt;</code>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-2"><strong class="text-white">Código:</strong></p>
                            <code class="text-cb-green">&lt;code&gt;código&lt;/code&gt;</code><br>
                            <code class="text-cb-green">&lt;pre&gt;&lt;code&gt;bloque&lt;/code&gt;&lt;/pre&gt;</code>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="flex items-center justify-between pt-6 border-t border-cb-border">
                    <a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white transition font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Cancelar
                    </a>
                    <button 
                        type="submit" 
                        class="bg-cb-green hover:bg-green-600 text-cb-dark font-bold py-3 px-8 rounded-lg transition inline-flex items-center space-x-2">
                        <i class="fas fa-check"></i>
                        <span>Publicar Artículo</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Contador de caracteres para excerpt
        const excerptTextarea = document.getElementById('excerpt');
        const excerptCount = document.getElementById('excerptCount');
        
        excerptTextarea.addEventListener('input', function() {
            excerptCount.textContent = this.value.length;
        });
        
        // Inicializar contador
        excerptCount.textContent = excerptTextarea.value.length;
    </script>
</x-app-layout>
