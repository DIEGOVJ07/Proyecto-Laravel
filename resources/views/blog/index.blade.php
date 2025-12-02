<x-app-web>
    <section class="bg-slate-950 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Blog y Tutoriales
                </h2>
                <p class="text-gray-400 mb-8 text-lg">
                    Aprende de los mejores y mejora tus habilidades
                </p>

                <div class="flex flex-wrap justify-center gap-3">
                    <button
                        class="px-6 py-2 rounded-lg bg-cyan-950/50 border border-cyan-500/50 text-cyan-400 font-medium shadow-[0_0_15px_rgba(6,182,212,0.15)]">
                        Todos
                    </button>
                    <button
                        class="px-6 py-2 rounded-lg bg-slate-900 border border-slate-800 text-gray-400 hover:border-cyan-500/30 hover:text-gray-200 transition-all">
                        Tutorial
                    </button>
                    <button
                        class="px-6 py-2 rounded-lg bg-slate-900 border border-slate-800 text-gray-400 hover:border-cyan-500/30 hover:text-gray-200 transition-all">
                        Algoritmos
                    </button>
                    <button
                        class="px-6 py-2 rounded-lg bg-slate-900 border border-slate-800 text-gray-400 hover:border-cyan-500/30 hover:text-gray-200 transition-all">
                        Soluciones
                    </button>
                    <button
                        class="px-6 py-2 rounded-lg bg-slate-900 border border-slate-800 text-gray-400 hover:border-cyan-500/30 hover:text-gray-200 transition-all">
                        Consejos
                    </button>
                </div>
            </div>

            <div class="mb-16 relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-500">
                </div>

                <div class="relative bg-slate-950 border border-slate-800 rounded-2xl p-8 md:p-12 overflow-hidden">
                    <div
                        class="inline-block px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-emerald-400 text-sm font-medium mb-6">
                        Destacado
                    </div>

                    <h3 class="text-3xl md:text-4xl font-bold text-white mb-6 leading-tight">
                        {{ $featuredPost['title'] }}
                    </h3>

                    <p class="text-gray-300 mb-8 text-lg max-w-3xl">
                        {{ $featuredPost['excerpt'] }}
                    </p>

                    <div class="flex flex-wrap items-center gap-6 mb-8 text-sm text-gray-400 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $featuredPost['author'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $featuredPost['date'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $featuredPost['readTime'] }} lectura</span>
                        </div>
                    </div>

                    <button
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-emerald-500 text-slate-950 font-bold rounded-lg hover:shadow-lg hover:shadow-cyan-500/25 transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Leer Artículo
                        <svg class="w-5 h-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                @foreach ($gridPosts as $post)
                    <div
                        class="group bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-cyan-500/30 transition-all duration-300 hover:-translate-y-1">

                        <div class="flex justify-between items-start mb-6">
                            <div class="text-4xl">
                                @if ($post['icon'] == 'link')
                                    🔗
                                @endif
                                @if ($post['icon'] == 'trophy')
                                    🏆
                                @endif
                                @if ($post['icon'] == 'lightning')
                                    ⚡
                                @endif
                                @if ($post['icon'] == 'puzzle')
                                    🧩
                                @endif
                                @if ($post['icon'] == 'book')
                                    📚
                                @endif
                            </div>

                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $post['category'] == 'Algoritmos' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' : '' }}
                            {{ $post['category'] == 'Soluciones' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : '' }}
                            {{ $post['category'] == 'Tutorial' ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : '' }}
                            {{ $post['category'] == 'Consejos' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : '' }}
                        ">
                                {{ $post['category'] }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-cyan-400 transition-colors">
                            {{ $post['title'] }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-6 line-clamp-3">
                            {{ $post['excerpt'] }}
                        </p>

                        <div class="flex items-center justify-between text-xs text-gray-500 mb-6 font-medium">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $post['author'] }}
                            </div>
                            <div class="flex items-center gap-4">
                                <span>{{ $post['date'] }}</span>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $post['readTime'] }}
                                </div>
                            </div>
                        </div>

                        <a href="#"
                            class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 text-sm font-semibold transition-colors">
                            Leer más
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-900/10 to-emerald-900/10 rounded-3xl"></div>

                <div
                    class="relative bg-slate-900/50 backdrop-blur-sm border border-cyan-500/20 rounded-3xl p-8 md:p-12 text-center">
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                        Suscríbete al Newsletter
                    </h3>
                    <p class="text-gray-400 mb-8 max-w-xl mx-auto">
                        Recibe tutoriales, consejos y análisis de problemas directamente en tu correo
                    </p>

                    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" placeholder="tu@email.com"
                            class="flex-1 bg-slate-950 border border-slate-800 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-all">
                        <button
                            class="px-6 py-3 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold rounded-lg transition-colors whitespace-nowrap shadow-lg shadow-emerald-500/20">
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</x-app-web>
