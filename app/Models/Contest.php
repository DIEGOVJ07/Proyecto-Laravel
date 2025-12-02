<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'difficulty',
        'start_date', 'duration', 'participants_count',
        'prize', 'tech_stack',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'tech_stack' => 'array',
    ];

    // --- LÓGICA DE FILTRADO ---
    public function scopeFilter(Builder $query, array $filters)
    {
        // 1. Filtro por Búsqueda (Search)
        if ($search = $filters['search'] ?? false) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        // 2. Filtro por Estado (Status)
        if ($status = $filters['status'] ?? false) {
            if ($status !== 'Todos') {
                $query->where('status', $status);
            }
        }

        // 3. Filtro por Dificultad (Difficulty)
        if ($difficulty = $filters['difficulty'] ?? false) {
            if ($difficulty !== 'Todos') {
                $query->where('difficulty', $difficulty);
            }
        }
    }
}
