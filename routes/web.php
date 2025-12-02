<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\WelcomeController;
use App\Models\Contest;
use App\Models\Leader;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/sedes', [SedeController::class, 'index'])->name('sedes.index');

// --- RUTA DASHBOARD (CONCURSOS) ---
Route::get('/dashboard', function () {
    // Filtramos los concursos según lo que el usuario busque
    $contests = Contest::latest()
        ->filter(request(['search', 'status', 'difficulty']))
        ->get();

    return view('concursos.index', ['contests' => $contests]);
})->name('dashboard');

// --- RUTA CLASIFICACIÓN (LEADERBOARD) ---
Route::get('/leaderboard', function () {
    // Obtener líderes ordenados por puntos
    $leaders = Leader::orderBy('points', 'desc')->get()->map(function ($leader, $index) {
        return [
            'rank' => $index + 1,
            'name' => $leader->name,
            'country' => $leader->country,
            'points' => number_format($leader->points),
            'wins' => $leader->wins,
            'solved' => $leader->solved,
            'trend' => $leader->trend,
            'initial' => $leader->initial,
            'color' => $leader->color,
        ];
    })->toArray();

    return view('clasificacion.index', ['leaders' => $leaders]);
})->name('leaderboard');

// Vista de estadísticas de CodeBattle (Mi Perfil)
Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');

// Configuración de perfil (Breeze - Cuenta)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
