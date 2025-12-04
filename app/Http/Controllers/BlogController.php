<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Dominando la Programación Dinámica: Guía Completa',
                'excerpt' => 'Aprende las técnicas fundamentales de programación dinámica con ejemplos prácticos y soluciones paso a paso.',
                'content' => 'La programación dinámica es una técnica esencial para resolver problemas complejos de optimización. En este artículo, exploraremos los conceptos fundamentales, técnicas de memorización, y aplicaremos estos conceptos a problemas reales de competencias de programación.',
                'author' => 'CodeMaster_3000',
                'author_avatar' => 'C',
                'date' => '24 Nov 2025',
                'read_time' => '15 min lectura',
                'category' => 'Algoritmos',
                'category_color' => 'bg-blue-500/20 text-blue-400 border-blue-500',
                'featured' => true,
                'image' => '💻',
                'views' => 1234,
                'likes' => 89,
            ],
            [
                'id' => 2,
                'title' => 'Top 10 Algoritmos de Grafos que Debes Conocer',
                'excerpt' => 'Una recopilación de los algoritmos de grafos más importantes en programación competitiva.',
                'content' => 'Los algoritmos de grafos son fundamentales en las competencias de programación. Desde BFS y DFS hasta algoritmos más avanzados como Dijkstra y Floyd-Warshall, este artículo cubre todo lo que necesitas saber.',
                'author' => 'AlgoQueen',
                'author_avatar' => 'A',
                'date' => '22 Nov 2025',
                'read_time' => '12 min lectura',
                'category' => 'Algoritmos',
                'category_color' => 'bg-blue-500/20 text-blue-400 border-blue-500',
                'featured' => false,
                'image' => '🔗',
                'views' => 982,
                'likes' => 67,
            ],
            [
                'id' => 3,
                'title' => 'Solución Explicada: CodeBattle Championship 2024',
                'excerpt' => 'Análisis detallado de las soluciones ganadoras del torneo más grande del año.',
                'content' => 'Desglosamos las estrategias y técnicas utilizadas por los ganadores del CodeBattle Championship 2024. Aprende de los mejores y mejora tus habilidades de resolución de problemas.',
                'author' => 'ByteNinja',
                'author_avatar' => 'B',
                'date' => '20 Nov 2025',
                'read_time' => '20 min lectura',
                'category' => 'Soluciones',
                'category_color' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500',
                'featured' => false,
                'image' => '🏆',
                'views' => 1567,
                'likes' => 124,
            ],
            [
                'id' => 4,
                'title' => 'Optimización de Código: Técnicas Avanzadas',
                'excerpt' => 'Descubre cómo optimizar tu código para pasar los casos de prueba más difíciles.',
                'content' => 'La optimización es clave en la programación competitiva. Aprende técnicas avanzadas para mejorar el rendimiento de tu código y reducir la complejidad temporal.',
                'author' => 'RecursiveGenius',
                'author_avatar' => 'R',
                'date' => '18 Nov 2025',
                'read_time' => '10 min lectura',
                'category' => 'Tutorial',
                'category_color' => 'bg-purple-500/20 text-purple-400 border-purple-500',
                'featured' => false,
                'image' => '⚡',
                'views' => 756,
                'likes' => 52,
            ],
            [
                'id' => 5,
                'title' => 'Estructuras de Datos Menos Conocidas pero Poderosas',
                'excerpt' => 'Explora estructuras de datos avanzadas que pueden darte ventaja en competencias.',
                'content' => 'Más allá de arrays y árboles, existen estructuras de datos especializadas que pueden resolver problemas complejos de manera eficiente. Descubre Segment Trees, Fenwick Trees y más.',
                'author' => 'BinaryBeast',
                'author_avatar' => 'B',
                'date' => '15 Nov 2025',
                'read_time' => '18 min lectura',
                'category' => 'Tutorial',
                'category_color' => 'bg-purple-500/20 text-purple-400 border-purple-500',
                'featured' => false,
                'image' => '🧩',
                'views' => 643,
                'likes' => 41,
            ],
            [
                'id' => 6,
                'title' => 'Cómo Prepararse para un Concurso de Programación',
                'excerpt' => 'Consejos y estrategias de los mejores competidores del mundo.',
                'content' => 'La preparación es fundamental para el éxito en competencias. Descubre las mejores prácticas, técnicas de estudio, y cómo mantener la calma bajo presión.',
                'author' => 'HashMapHero',
                'author_avatar' => 'H',
                'date' => '12 Nov 2025',
                'read_time' => '8 min lectura',
                'category' => 'Consejos',
                'category_color' => 'bg-green-500/20 text-green-400 border-green-500',
                'featured' => false,
                'image' => '📚',
                'views' => 891,
                'likes' => 73,
            ],
        ];

        $featuredPost = collect($posts)->firstWhere('featured', true);
        $recentPosts = collect($posts)->where('featured', false)->take(5);
        
        $categories = [
            ['name' => 'Todos', 'count' => count($posts), 'color' => 'bg-cb-green'],
            ['name' => 'Algoritmos', 'count' => 2, 'color' => 'bg-blue-500'],
            ['name' => 'Soluciones', 'count' => 1, 'color' => 'bg-yellow-500'],
            ['name' => 'Tutorial', 'count' => 2, 'color' => 'bg-purple-500'],
            ['name' => 'Consejos', 'count' => 1, 'color' => 'bg-green-500'],
        ];

        return view('blog.index', compact('posts', 'featuredPost', 'recentPosts', 'categories'));
    }

    public function show($id)
    {
        // Aquí puedes agregar lógica para mostrar un artículo individual
        return redirect()->route('blog.index');
    }
}