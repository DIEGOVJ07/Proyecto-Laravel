<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Dominando la Programación Dinámica: Guía Completa',
                'excerpt' => 'Aprende las técnicas fundamentales de programación dinámica con ejemplos prácticos y soluciones paso a paso.',
                'author' => 'CodeMaster_3000',
                'date' => '24 Nov 2025',
                'readTime' => '15 min',
                'category' => 'Destacado',
                'icon' => 'code', // Identificador para saber qué icono poner
            ],
            [
                'id' => 2,
                'title' => 'Top 10 Algoritmos de Grafos que Debes Conocer',
                'excerpt' => 'Una recopilación de los algoritmos de grafos más importantes en programación competitiva.',
                'author' => 'AlgoQueen',
                'date' => '22 Nov 2025',
                'readTime' => '12 min',
                'category' => 'Algoritmos',
                'icon' => 'link',
            ],
            [
                'id' => 3,
                'title' => 'Solución Explicada: CodeBattle Championship 2024',
                'excerpt' => 'Análisis detallado de las soluciones ganadoras del torneo más grande del año.',
                'author' => 'ByteNinja',
                'date' => '20 Nov 2025',
                'readTime' => '20 min',
                'category' => 'Soluciones',
                'icon' => 'trophy',
            ],
            [
                'id' => 4,
                'title' => 'Optimización de Código: Técnicas Avanzadas',
                'excerpt' => 'Descubre cómo optimizar tu código para pasar los casos de prueba más difíciles.',
                'author' => 'RecursiveGenius',
                'date' => '18 Nov 2025',
                'readTime' => '10 min',
                'category' => 'Tutorial',
                'icon' => 'lightning',
            ],
            [
                'id' => 5,
                'title' => 'Estructuras de Datos Menos Conocidas pero Poderosas',
                'excerpt' => 'Explora estructuras de datos avanzadas que pueden darte ventaja en competencias.',
                'author' => 'BinaryBeast',
                'date' => '15 Nov 2025',
                'readTime' => '18 min',
                'category' => 'Tutorial',
                'icon' => 'puzzle',
            ],
            [
                'id' => 6,
                'title' => 'Cómo Prepararse para un Concurso de Programación',
                'excerpt' => 'Consejos y estrategias de los mejores competidores del mundo.',
                'author' => 'HashMapHero',
                'date' => '12 Nov 2025',
                'readTime' => '8 min',
                'category' => 'Consejos',
                'icon' => 'book',
            ],
        ];

        // Separamos el post destacado (el primero) del resto
        $featuredPost = $posts[0];
        $gridPosts = array_slice($posts, 1);

        return view('blog.index', compact('featuredPost', 'gridPosts'));
    }
}
