<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BlogController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $selectedCategory = $request->get('category', 'Todos');
        
        // Obtener posts publicados desde la base de datos
        $query = Post::with('author')
            ->published()
            ->byCategory($selectedCategory)
            ->orderBy('published_at', 'desc');
        
        $posts = $query->paginate(12);
        
        // Categorías con conteo real
        $categories = [
            ['name' => 'Todos', 'count' => Post::published()->count(), 'color' => 'cb-green'],
            ['name' => 'Algoritmos', 'count' => Post::published()->where('category', 'Algoritmos')->count(), 'color' => 'blue-500'],
            ['name' => 'Estructuras de Datos', 'count' => Post::published()->where('category', 'Estructuras de Datos')->count(), 'color' => 'cyan-500'],
            ['name' => 'Competencias', 'count' => Post::published()->where('category', 'Competencias')->count(), 'color' => 'yellow-500'],
            ['name' => 'Tips y Trucos', 'count' => Post::published()->where('category', 'Tips y Trucos')->count(), 'color' => 'green-500'],
        ];

        return view('blog.index', compact('posts', 'categories', 'selectedCategory'));
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'likes'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        // Incrementar vistas
        $post->incrementViews();
        
        // Verificar si el usuario actual ha dado like
        $userLiked = Auth::check() ? $post->isLikedBy(Auth::user()) : false;
        
        // Posts relacionados
        $relatedPosts = Post::published()
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        
        return view('blog.show', compact('post', 'userLiked', 'relatedPosts'));
    }

    public function create()
    {
        // Solo admins y super_admins pueden crear posts
        $this->authorize('create', Post::class);
        
        $categories = ['Algoritmos', 'Estructuras de Datos', 'Competencias', 'Tips y Trucos'];
        
        return view('blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'author_id' => Auth::id(),
            'published_at' => now(),
        ]);

        return redirect()->route('blog.show', $post->slug)
            ->with('success', '¡Artículo publicado exitosamente!');
    }

    public function like(Post $post)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Debes iniciar sesión para dar like'
            ], 401);
        }

        $liked = $post->toggleLike(Auth::user());

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $post->likes_count
        ]);
    }
}
