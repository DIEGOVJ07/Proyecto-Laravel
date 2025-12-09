<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios admin para asignar como autores
        $admins = User::role(['admin', 'super_admin'])->get();
        
        if ($admins->isEmpty()) {
            $this->command->warn('No hay administradores en la base de datos. Ejecuta DatabaseSeeder primero.');
            return;
        }

        $posts = [
            [
                'title' => 'Introducción a los Algoritmos de Ordenamiento',
                'excerpt' => 'Descubre los fundamentos de los algoritmos de ordenamiento más utilizados en programación competitiva y su análisis de complejidad.',
                'content' => '<h2>¿Por qué son importantes los algoritmos de ordenamiento?</h2>
<p>Los algoritmos de ordenamiento son fundamentales en ciencias de la computación y programación competitiva. Permiten organizar datos de manera eficiente, lo que facilita búsquedas, análisis y procesamiento posterior.</p>

<h3>Bubble Sort - El más simple</h3>
<p>El algoritmo de ordenamiento burbuja compara elementos adyacentes y los intercambia si están en el orden incorrecto. Aunque tiene una complejidad de <strong>O(n²)</strong>, es excelente para comprender los conceptos básicos.</p>

<pre><code>void bubbleSort(int arr[], int n) {
    for (int i = 0; i < n-1; i++) {
        for (int j = 0; j < n-i-1; j++) {
            if (arr[j] > arr[j+1]) {
                swap(arr[j], arr[j+1]);
            }
        }
    }
}</code></pre>

<h3>Quick Sort - Divide y vencerás</h3>
<p>Quick Sort utiliza el paradigma divide y vencerás. Selecciona un pivote y particiona el array en elementos menores y mayores. Su complejidad promedio es <strong>O(n log n)</strong>, lo que lo hace ideal para competencias.</p>

<h3>Merge Sort - Estable y confiable</h3>
<p>Merge Sort divide el array recursivamente y luego combina las partes ordenadas. Garantiza <strong>O(n log n)</strong> en todos los casos y es estable, preservando el orden relativo de elementos iguales.</p>

<h3>Consejos para competencias</h3>
<ul>
<li>Usa <code>sort()</code> de la STL en C++ o <code>Arrays.sort()</code> en Java para ahorrar tiempo</li>
<li>Conoce la complejidad de cada algoritmo para elegir el adecuado</li>
<li>Practica implementaciones desde cero para entrevistas</li>
<li>Considera el espacio de memoria además del tiempo de ejecución</li>
</ul>',
                'category' => 'Algoritmos',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(15, 45),
                'views_count' => rand(100, 300),
                'published_at' => now()->subDays(rand(1, 30)),
            ],
            [
                'title' => 'Estructuras de Datos Avanzadas: Segment Trees',
                'excerpt' => 'Aprende a implementar y utilizar Segment Trees para resolver problemas de consultas en rangos de manera eficiente.',
                'content' => '<h2>¿Qué es un Segment Tree?</h2>
<p>Un Segment Tree (árbol de segmentos) es una estructura de datos que permite realizar consultas y actualizaciones en rangos con complejidad <strong>O(log n)</strong>. Es extremadamente útil en programación competitiva para problemas que involucran sumas, mínimos, máximos u operaciones asociativas en rangos.</p>

<h3>Casos de uso comunes</h3>
<ul>
<li>Consultas de suma en rangos</li>
<li>Encontrar el mínimo/máximo en un rango</li>
<li>Actualizaciones de elementos individuales o rangos</li>
<li>Problemas de Range Minimum Query (RMQ)</li>
</ul>

<h3>Implementación básica</h3>
<p>La estructura consiste en un árbol binario donde cada nodo representa un segmento del array. Las hojas representan elementos individuales, mientras que los nodos internos almacenan información agregada de sus hijos.</p>

<pre><code>class SegmentTree {
    vector<int> tree;
    int n;
    
    void build(vector<int>& arr, int node, int start, int end) {
        if (start == end) {
            tree[node] = arr[start];
        } else {
            int mid = (start + end) / 2;
            build(arr, 2*node, start, mid);
            build(arr, 2*node+1, mid+1, end);
            tree[node] = tree[2*node] + tree[2*node+1];
        }
    }
    
    int query(int node, int start, int end, int l, int r) {
        if (r < start || end < l) return 0;
        if (l <= start && end <= r) return tree[node];
        int mid = (start + end) / 2;
        return query(2*node, start, mid, l, r) + 
               query(2*node+1, mid+1, end, l, r);
    }
};</code></pre>

<h3>Lazy Propagation</h3>
<p>Para actualizar rangos de manera eficiente, se utiliza la técnica de lazy propagation. En lugar de actualizar todos los nodos inmediatamente, se marca la actualización y se propaga solo cuando es necesario.</p>

<h3>Problemas recomendados</h3>
<p>Practica con estos problemas clásicos:</p>
<ul>
<li>CSES - Range Sum Queries</li>
<li>Codeforces - Education Round: Segment Tree</li>
<li>LeetCode - Range Sum Query</li>
</ul>',
                'category' => 'Estructuras de Datos',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(20, 50),
                'views_count' => rand(150, 400),
                'published_at' => now()->subDays(rand(1, 25)),
            ],
            [
                'title' => 'Programación Dinámica: De Principiante a Experto',
                'excerpt' => 'Guía completa para dominar la programación dinámica, desde conceptos básicos hasta problemas avanzados de competencias internacionales.',
                'content' => '<h2>Fundamentos de Programación Dinámica</h2>
<p>La programación dinámica (DP) es una técnica de optimización que resuelve problemas complejos dividiéndolos en subproblemas más simples. La clave está en almacenar las soluciones de subproblemas para evitar cálculos repetidos.</p>

<h3>Propiedades clave</h3>
<p>Un problema es candidato para DP si tiene:</p>
<ul>
<li><strong>Subestructura óptima:</strong> La solución óptima contiene soluciones óptimas de subproblemas</li>
<li><strong>Subproblemas superpuestos:</strong> El mismo subproblema se resuelve múltiples veces</li>
</ul>

<h3>Top-Down vs Bottom-Up</h3>
<p><strong>Top-Down (Memoización):</strong> Implementación recursiva que almacena resultados en caché. Más intuitivo pero puede tener overhead de recursión.</p>

<pre><code>int fib(int n, vector<int>& memo) {
    if (n <= 1) return n;
    if (memo[n] != -1) return memo[n];
    return memo[n] = fib(n-1, memo) + fib(n-2, memo);
}</code></pre>

<p><strong>Bottom-Up (Tabulación):</strong> Iterativo, construye la solución desde los casos base. Más eficiente en espacio y tiempo.</p>

<pre><code>int fib(int n) {
    vector<int> dp(n+1);
    dp[0] = 0; dp[1] = 1;
    for (int i = 2; i <= n; i++) {
        dp[i] = dp[i-1] + dp[i-2];
    }
    return dp[n];
}</code></pre>

<h3>Problemas clásicos para practicar</h3>
<ol>
<li><strong>Knapsack (Mochila):</strong> Fundamento de muchos problemas de optimización</li>
<li><strong>Longest Common Subsequence (LCS):</strong> Esencial para procesamiento de strings</li>
<li><strong>Edit Distance:</strong> Aplicaciones en procesamiento de texto</li>
<li><strong>Coin Change:</strong> Problema de cambio de monedas</li>
<li><strong>Matrix Chain Multiplication:</strong> Optimización de multiplicación de matrices</li>
</ol>

<h3>Estrategia para resolver problemas DP</h3>
<ol>
<li>Identifica el estado (variables que definen un subproblema)</li>
<li>Define la relación de recurrencia</li>
<li>Determina los casos base</li>
<li>Decide el orden de cálculo (top-down o bottom-up)</li>
<li>Optimiza el espacio si es posible</li>
</ol>

<h3>Recursos recomendados</h3>
<ul>
<li>CSES Problem Set - Dynamic Programming Section</li>
<li>AtCoder Educational DP Contest</li>
<li>LeetCode DP Tag (ordenado por dificultad)</li>
</ul>',
                'category' => 'Algoritmos',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(30, 60),
                'views_count' => rand(200, 500),
                'published_at' => now()->subDays(rand(1, 20)),
            ],
            [
                'title' => 'Preparación Mental para Competencias de Programación',
                'excerpt' => 'Estrategias y consejos para mantener la calma, gestionar el tiempo y rendir al máximo durante competencias de alto nivel.',
                'content' => '<h2>El aspecto mental de la programación competitiva</h2>
<p>La habilidad técnica es solo una parte del éxito en competencias. La preparación mental, gestión del estrés y estrategias durante la competencia son igualmente importantes.</p>

<h3>Antes de la competencia</h3>
<ul>
<li><strong>Descansa bien:</strong> Dormir 7-8 horas la noche anterior es crucial</li>
<li><strong>Revisa conceptos básicos:</strong> No intentes aprender algo nuevo el día antes</li>
<li><strong>Prepara tu entorno:</strong> Verifica tu setup, conexión a internet, templates</li>
<li><strong>Ejercicio ligero:</strong> Una caminata de 15 minutos ayuda a oxigenar el cerebro</li>
</ul>

<h3>Durante la competencia</h3>
<h4>Primeros 15 minutos</h4>
<p>Lee todos los problemas rápidamente. Identifica cuáles son más accesibles. No te quedes atascado en el primer problema si no fluye.</p>

<h4>Gestión del tiempo</h4>
<ul>
<li>Resuelve primero los problemas que sabes cómo abordar</li>
<li>Si llevas más de 20 minutos sin avances, considera cambiar de problema</li>
<li>Deja 30 minutos finales para revisar y optimizar</li>
</ul>

<h4>Manejo del estrés</h4>
<ul>
<li><strong>Respiración:</strong> 4 segundos inhalar, 4 segundos exhalar cuando sientas ansiedad</li>
<li><strong>No compares:</strong> Enfócate en tu propio progreso, no en el scoreboard</li>
<li><strong>Los errores son normales:</strong> Un WA no es el fin del mundo</li>
</ul>

<h3>Estrategias de debugging</h3>
<ol>
<li>Lee tu código como si fuera de otra persona</li>
<li>Prueba con casos extremos (0, 1, máximo permitido)</li>
<li>Verifica límites de arrays y overflow</li>
<li>Imprime variables intermedias si es necesario</li>
<li>Si todo falla, reescribe desde cero (a veces es más rápido)</li>
</ol>

<h3>Después de la competencia</h3>
<p>Analiza tu desempeño objetivamente:</p>
<ul>
<li>¿Qué problemas pudiste haber resuelto pero no intentaste?</li>
<li>¿Perdiste tiempo en problemas muy difíciles?</li>
<li>¿Qué conceptos necesitas reforzar?</li>
</ul>

<h3>Mentalidad de crecimiento</h3>
<p>Cada competencia es una oportunidad de aprendizaje. Los mejores competidores no son los que nunca fallan, sino los que aprenden de cada error.</p>

<blockquote>
<p>"El éxito no es definitivo, el fracaso no es fatal: es el coraje de continuar lo que cuenta." - Winston Churchill</p>
</blockquote>',
                'category' => 'Competencias',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(25, 55),
                'views_count' => rand(180, 450),
                'published_at' => now()->subDays(rand(1, 15)),
            ],
            [
                'title' => 'Grafos: BFS, DFS y Algoritmos Fundamentales',
                'excerpt' => 'Explora los algoritmos esenciales de grafos que todo competidor debe dominar, con ejemplos prácticos y casos de uso.',
                'content' => '<h2>Fundamentos de Teoría de Grafos</h2>
<p>Los grafos son estructuras versátiles que modelan relaciones entre objetos. En programación competitiva, aproximadamente el 20-30% de los problemas involucran grafos de alguna forma.</p>

<h3>Representación de Grafos</h3>

<h4>Lista de Adyacencia (Recomendada)</h4>
<p>Eficiente en espacio para grafos dispersos. Complejidad espacial: O(V + E)</p>

<pre><code>vector<vector<int>> adj(n);
adj[u].push_back(v); // Agregar arista u -> v</code></pre>

<h4>Matriz de Adyacencia</h4>
<p>Útil para grafos densos o cuando necesitas verificar existencia de aristas en O(1).</p>

<pre><code>vector<vector<bool>> adj(n, vector<bool>(n, false));
adj[u][v] = true; // Arista u -> v</code></pre>

<h3>BFS (Búsqueda en Anchura)</h3>
<p>Explora el grafo nivel por nivel. Ideal para:</p>
<ul>
<li>Encontrar el camino más corto en grafos no ponderados</li>
<li>Verificar bipartición</li>
<li>Componentes conexos</li>
</ul>

<pre><code>void bfs(int start, vector<vector<int>>& adj) {
    vector<bool> visited(adj.size(), false);
    queue<int> q;
    
    q.push(start);
    visited[start] = true;
    
    while (!q.empty()) {
        int u = q.front();
        q.pop();
        
        for (int v : adj[u]) {
            if (!visited[v]) {
                visited[v] = true;
                q.push(v);
            }
        }
    }
}</code></pre>

<h3>DFS (Búsqueda en Profundidad)</h3>
<p>Explora tan profundo como sea posible antes de retroceder. Aplicaciones:</p>
<ul>
<li>Detección de ciclos</li>
<li>Ordenamiento topológico</li>
<li>Encontrar componentes fuertemente conexos</li>
<li>Backtracking en grafos</li>
</ul>

<pre><code>void dfs(int u, vector<vector<int>>& adj, vector<bool>& visited) {
    visited[u] = true;
    
    for (int v : adj[u]) {
        if (!visited[v]) {
            dfs(v, adj, visited);
        }
    }
}</code></pre>

<h3>Dijkstra - Camino más corto</h3>
<p>Para grafos con pesos no negativos. Complejidad: O((V + E) log V) con priority queue.</p>

<pre><code>vector<int> dijkstra(int start, vector<vector<pair<int,int>>>& adj) {
    int n = adj.size();
    vector<int> dist(n, INT_MAX);
    priority_queue<pair<int,int>, vector<pair<int,int>>, greater<>> pq;
    
    dist[start] = 0;
    pq.push({0, start});
    
    while (!pq.empty()) {
        auto [d, u] = pq.top();
        pq.pop();
        
        if (d > dist[u]) continue;
        
        for (auto [v, w] : adj[u]) {
            if (dist[u] + w < dist[v]) {
                dist[v] = dist[u] + w;
                pq.push({dist[v], v});
            }
        }
    }
    
    return dist;
}</code></pre>

<h3>Union-Find (DSU)</h3>
<p>Estructura fundamental para problemas de conectividad y componentes. Soporta operaciones de unión y búsqueda en casi O(1) amortizado.</p>

<h3>Problemas recomendados</h3>
<ol>
<li><strong>BFS:</strong> CSES - Message Route</li>
<li><strong>DFS:</strong> CSES - Building Roads</li>
<li><strong>Dijkstra:</strong> CSES - Shortest Routes I</li>
<li><strong>Union-Find:</strong> CSES - Road Construction</li>
</ol>',
                'category' => 'Algoritmos',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(20, 45),
                'views_count' => rand(160, 420),
                'published_at' => now()->subDays(rand(1, 18)),
            ],
            [
                'title' => 'Análisis de Competencias: ICPC vs Codeforces vs AtCoder',
                'excerpt' => 'Comparativa detallada de las principales plataformas de programación competitiva y cómo prepararse para cada una.',
                'content' => '<h2>Plataformas de Programación Competitiva</h2>
<p>Cada plataforma tiene sus características únicas, estilos de problemas y formatos de competencia. Conocer estas diferencias te ayudará a prepararte mejor.</p>

<h3>ICPC (International Collegiate Programming Contest)</h3>
<h4>Características</h4>
<ul>
<li>Competencia en equipos de 3 personas</li>
<li>Una sola computadora por equipo</li>
<li>5 horas, 10-13 problemas</li>
<li>Sistema de penalización por intentos incorrectos</li>
<li>Verificación manual de problemas (a veces)</li>
</ul>

<h4>Estilo de problemas</h4>
<p>Énfasis en:</p>
<ul>
<li>Problemas de implementación compleja</li>
<li>Geometría computacional</li>
<li>Teoría de números</li>
<li>Problemas de simulación</li>
<li>Trabajo en equipo y distribución de tareas</li>
</ul>

<h4>Estrategia de equipo</h4>
<ul>
<li><strong>Especialización:</strong> Un miembro fuerte en geometría, otro en DP, otro en grafos</li>
<li><strong>Comunicación:</strong> Discutir ideas rápidamente sin monopolizar tiempo</li>
<li><strong>Rotación de PC:</strong> Implementar problemas en orden de complejidad vs tiempo</li>
</ul>

<h3>Codeforces</h3>
<h4>Características</h4>
<ul>
<li>Competencias regulares (2-3 por semana)</li>
<li>Sistema de rating dinámico (Elo-like)</li>
<li>2-2.5 horas, 5-7 problemas</li>
<li>Puntaje decreciente con el tiempo</li>
<li>Hacking phase (puedes atacar soluciones de otros)</li>
</ul>

<h4>Estilo de problemas</h4>
<p>Énfasis en:</p>
<ul>
<li>Observaciones matemáticas ingeniosas</li>
<li>Problemas constructivos</li>
<li>Problemas interactivos</li>
<li>Optimización y análisis de complejidad</li>
</ul>

<h4>Tips para Codeforces</h4>
<ul>
<li>Lee todos los problemas en los primeros 10-15 minutos</li>
<li>Resuelve en orden de dificultad estimada, no necesariamente A → B → C</li>
<li>Protege tu código en el hacking phase con casos extremos</li>
<li>Practica problemas de tu rating + 200-300 para mejorar</li>
</ul>

<h3>AtCoder</h3>
<h4>Características</h4>
<ul>
<li>Competencias semanales (ABC, ARC, AGC)</li>
<li>Problemas muy bien testeados</li>
<li>Editorial de alta calidad</li>
<li>100 minutos típicamente</li>
<li>Sistema de puntaje parcial en algunos problemas</li>
</ul>

<h4>Estilo de problemas</h4>
<p>Énfasis en:</p>
<ul>
<li>Problemas elegantes con soluciones cortas</li>
<li>Fuerte componente matemático</li>
<li>Problemas de observación</li>
<li>Educational DP Contest (excelente para aprender)</li>
</ul>

<h4>Niveles de dificultad</h4>
<ul>
<li><strong>ABC (AtCoder Beginner Contest):</strong> Para iniciantes y nivel intermedio</li>
<li><strong>ARC (AtCoder Regular Contest):</strong> Nivel intermedio-avanzado</li>
<li><strong>AGC (AtCoder Grand Contest):</strong> Nivel experto</li>
</ul>

<h3>¿Cuál elegir para practicar?</h3>
<ul>
<li><strong>Principiante:</strong> AtCoder ABC + Codeforces Div. 3/4</li>
<li><strong>Intermedio:</strong> Codeforces Div. 2 + AtCoder ARC</li>
<li><strong>Avanzado:</strong> Codeforces Div. 1 + AtCoder AGC + ICPC Regionales</li>
</ul>

<h3>Plan de entrenamiento sugerido</h3>
<ol>
<li>Participa en contests virtuales 2-3 veces por semana</li>
<li>Resuelve upsolving de problemas que no pudiste en contest</li>
<li>Dedica 1-2 días a practicar temas específicos</li>
<li>Mantén un notebook con algoritmos y estructuras clave</li>
</ol>',
                'category' => 'Competencias',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(30, 65),
                'views_count' => rand(220, 550),
                'published_at' => now()->subDays(rand(1, 12)),
            ],
            [
                'title' => 'Strings: KMP, Z-Algorithm y Rolling Hash',
                'excerpt' => 'Domina los algoritmos avanzados de procesamiento de strings para resolver problemas de búsqueda de patrones eficientemente.',
                'content' => '<h2>Algoritmos de Strings en Programación Competitiva</h2>
<p>El procesamiento eficiente de cadenas es crucial en muchos problemas. Estos algoritmos permiten resolver problemas de búsqueda y comparación en tiempo lineal o casi lineal.</p>

<h3>KMP (Knuth-Morris-Pratt)</h3>
<p>Busca un patrón en un texto en O(n + m) usando información de prefijos para evitar comparaciones redundantes.</p>

<h4>Array de Prefijos</h4>
<p>El array de prefijos (LPS - Longest Proper Prefix which is also Suffix) es la clave del algoritmo:</p>

<pre><code>vector<int> computeLPS(string pattern) {
    int m = pattern.length();
    vector<int> lps(m, 0);
    int len = 0;
    
    for (int i = 1; i < m; ) {
        if (pattern[i] == pattern[len]) {
            len++;
            lps[i] = len;
            i++;
        } else {
            if (len != 0) {
                len = lps[len - 1];
            } else {
                lps[i] = 0;
                i++;
            }
        }
    }
    return lps;
}</code></pre>

<h4>Búsqueda con KMP</h4>
<pre><code>vector<int> KMP(string text, string pattern) {
    vector<int> lps = computeLPS(pattern);
    vector<int> matches;
    int i = 0, j = 0;
    int n = text.length(), m = pattern.length();
    
    while (i < n) {
        if (text[i] == pattern[j]) {
            i++; j++;
        }
        
        if (j == m) {
            matches.push_back(i - j);
            j = lps[j - 1];
        } else if (i < n && text[i] != pattern[j]) {
            if (j != 0) {
                j = lps[j - 1];
            } else {
                i++;
            }
        }
    }
    return matches;
}</code></pre>

<h3>Z-Algorithm</h3>
<p>Construye un array Z donde Z[i] es la longitud del substring más largo que comienza en i y que también es prefijo de la cadena. Complejidad: O(n)</p>

<pre><code>vector<int> zAlgorithm(string s) {
    int n = s.length();
    vector<int> z(n);
    int l = 0, r = 0;
    
    for (int i = 1; i < n; i++) {
        if (i > r) {
            l = r = i;
            while (r < n && s[r - l] == s[r]) r++;
            z[i] = r - l;
            r--;
        } else {
            int k = i - l;
            if (z[k] < r - i + 1) {
                z[i] = z[k];
            } else {
                l = i;
                while (r < n && s[r - l] == s[r]) r++;
                z[i] = r - l;
                r--;
            }
        }
    }
    return z;
}</code></pre>

<h4>Aplicaciones del Z-Algorithm</h4>
<ul>
<li>Búsqueda de patrones (concatena pattern + "$" + text)</li>
<li>Encontrar periodicidad en strings</li>
<li>Problemas de prefix matching</li>
</ul>

<h3>Rolling Hash (Rabin-Karp)</h3>
<p>Técnica de hashing que permite comparar substrings en O(1) después de un preprocesamiento O(n).</p>

<pre><code>class RollingHash {
    const long long MOD = 1e9 + 7;
    const long long BASE = 31;
    vector<long long> hash, pow;
    
public:
    RollingHash(string s) {
        int n = s.length();
        hash.resize(n + 1);
        pow.resize(n + 1);
        pow[0] = 1;
        
        for (int i = 0; i < n; i++) {
            hash[i + 1] = (hash[i] * BASE + (s[i] - \'a\' + 1)) % MOD;
            pow[i + 1] = (pow[i] * BASE) % MOD;
        }
    }
    
    long long getHash(int l, int r) {
        long long val = (hash[r] - hash[l] * pow[r - l]) % MOD;
        return (val + MOD) % MOD;
    }
};</code></pre>

<h4>Ventajas del Rolling Hash</h4>
<ul>
<li>Comparación de substrings en O(1)</li>
<li>Fácil de implementar</li>
<li>Útil para problemas de duplicados</li>
<li>Combina bien con otras técnicas</li>
</ul>

<h4>Precauciones</h4>
<ul>
<li>Posibilidad de colisiones (usar doble hash si es crítico)</li>
<li>Elegir BASE y MOD apropiados</li>
<li>Cuidado con el overflow</li>
</ul>

<h3>Comparación de algoritmos</h3>
<table>
<tr><th>Algoritmo</th><th>Complejidad</th><th>Mejor uso</th></tr>
<tr><td>KMP</td><td>O(n+m)</td><td>Búsqueda exacta de patrón</td></tr>
<tr><td>Z-Algorithm</td><td>O(n)</td><td>Prefix matching múltiple</td></tr>
<tr><td>Rolling Hash</td><td>O(n) prep, O(1) query</td><td>Comparación de substrings</td></tr>
</table>

<h3>Problemas recomendados</h3>
<ul>
<li>CSES - String Matching (KMP)</li>
<li>CSES - Finding Periods (Z-Algorithm)</li>
<li>Codeforces - String Hashing problems</li>
</ul>',
                'category' => 'Algoritmos',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(18, 42),
                'views_count' => rand(140, 380),
                'published_at' => now()->subDays(rand(1, 22)),
            ],
            [
                'title' => 'Técnicas de Optimización: De TLE a AC',
                'excerpt' => 'Aprende a identificar cuellos de botella en tu código y aplicar técnicas de optimización para pasar los límites de tiempo.',
                'content' => '<h2>Cuando tu código es correcto pero demasiado lento</h2>
<p>Recibir un veredicto de Time Limit Exceeded (TLE) es frustrante, especialmente cuando sabes que tu lógica es correcta. Aquí aprenderás a optimizar efectivamente.</p>

<h3>Análisis de Complejidad Temporal</h3>
<p>Antes de optimizar, necesitas entender cuántas operaciones puede tu código ejecutar:</p>

<table>
<tr><th>n (input size)</th><th>Complejidad máxima</th></tr>
<tr><td>n ≤ 10</td><td>O(n!), O(n^6)</td></tr>
<tr><td>n ≤ 20</td><td>O(2^n)</td></tr>
<tr><td>n ≤ 500</td><td>O(n^3)</td></tr>
<tr><td>n ≤ 5000</td><td>O(n^2)</td></tr>
<tr><td>n ≤ 10^6</td><td>O(n log n)</td></tr>
<tr><td>n ≤ 10^8</td><td>O(n)</td></tr>
</table>

<p>Regla general: ~10^8 operaciones por segundo en jueces modernos.</p>

<h3>Optimizaciones de Algoritmo</h3>

<h4>1. Eliminar bucles innecesarios</h4>
<p>Busca patrones que se puedan calcular con fórmulas matemáticas:</p>

<pre><code>// Lento O(n)
int sum = 0;
for (int i = 1; i <= n; i++) sum += i;

// Rápido O(1)
int sum = n * (n + 1) / 2;</code></pre>

<h4>2. Precálculo y memorización</h4>
<p>Calcula valores una vez y reutilízalos:</p>

<pre><code>// Precalcular factoriales
vector<long long> fact(N);
fact[0] = 1;
for (int i = 1; i < N; i++) {
    fact[i] = fact[i-1] * i % MOD;
}</code></pre>

<h4>3. Binary Search en lugar de Linear Search</h4>
<pre><code>// Lento O(n)
for (int i = 0; i < n; i++) {
    if (arr[i] == target) return i;
}

// Rápido O(log n) si está ordenado
auto it = lower_bound(arr.begin(), arr.end(), target);
if (it != arr.end() && *it == target) return it - arr.begin();</code></pre>

<h3>Optimizaciones de Código</h3>

<h4>1. Evitar copias innecesarias</h4>
<pre><code>// Lento - copia todo el vector
void process(vector<int> v) { ... }

// Rápido - pasa por referencia
void process(const vector<int>& v) { ... }</code></pre>

<h4>2. Reservar memoria de antemano</h4>
<pre><code>vector<int> v;
v.reserve(N); // Evita realocaciones múltiples
for (int i = 0; i < N; i++) {
    v.push_back(i);
}</code></pre>

<h4>3. Usar tipos de datos apropiados</h4>
<pre><code>// Si los valores son pequeños, usa int en lugar de long long
// Operaciones con int son más rápidas

// Usa array<> si el tamaño es fijo
array<int, 100> arr; // Más rápido que vector<int> arr(100);</code></pre>

<h4>4. Optimizar I/O</h4>
<pre><code>// Acelerar cin/cout significativamente
ios_base::sync_with_stdio(false);
cin.tie(nullptr);

// Para múltiples outputs, considera usar \'\\n\' en lugar de endl
cout << result << \'\\n\'; // endl hace flush, \'\\n\' no</code></pre>

<h3>Optimizaciones Específicas de C++</h3>

<h4>Pragmas del compilador</h4>
<pre><code>#pragma GCC optimize("O3")
#pragma GCC target("avx2")
#pragma GCC optimize("unroll-loops")</code></pre>

<h4>Inline functions para operaciones frecuentes</h4>
<pre><code>inline int fastMod(int x, int m) {
    return x >= m ? x % m : x;
}</code></pre>

<h3>Técnicas avanzadas</h3>

<h4>1. Bitwise operations</h4>
<p>Son más rápidas que operaciones aritméticas:</p>
<pre><code>x >> 1     // Equivale a x / 2
x << 1     // Equivale a x * 2
x & 1      // Verifica si es impar
x & (x-1)  // Elimina el bit menos significativo</code></pre>

<h4>2. Loop unrolling</h4>
<p>Reduce overhead de bucles:</p>
<pre><code>// En lugar de
for (int i = 0; i < n; i++) process(arr[i]);

// Considera (si n es múltiplo de 4)
for (int i = 0; i < n; i += 4) {
    process(arr[i]);
    process(arr[i+1]);
    process(arr[i+2]);
    process(arr[i+3]);
}</code></pre>

<h3>Herramientas de profiling</h3>
<ul>
<li><strong>time:</strong> Mide tiempo de ejecución</li>
<li><strong>gprof:</strong> Profiling detallado</li>
<li><strong>valgrind --tool=callgrind:</strong> Análisis de llamadas</li>
<li><strong>Custom timer:</strong> Medir secciones específicas del código</li>
</ul>

<h3>Checklist de optimización</h3>
<ol>
<li>¿Es el algoritmo óptimo para el problema?</li>
<li>¿Hay cálculos repetidos que puedas cachear?</li>
<li>¿Estás usando las estructuras de datos correctas?</li>
<li>¿Hay operaciones dentro de loops que pueden sacarse?</li>
<li>¿Tu I/O está optimizada?</li>
<li>¿Estás usando tipos de datos apropiados?</li>
<li>¿Pasas grandes objetos por valor en lugar de referencia?</li>
</ol>

<p><strong>Recuerda:</strong> Primero haz que funcione, luego optimiza solo lo necesario. La optimización prematura puede complicar innecesariamente el código.</p>',
                'category' => 'Tips y Trucos',
                'author_id' => $admins->random()->id,
                'likes_count' => rand(22, 48),
                'views_count' => rand(170, 440),
                'published_at' => now()->subDays(rand(1, 14)),
            ],
        ];

        foreach ($posts as $postData) {
            Post::create($postData);
        }

        $this->command->info('✅ Posts creados exitosamente');
    }
}
