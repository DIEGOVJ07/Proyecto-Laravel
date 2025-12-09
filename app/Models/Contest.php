<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $guarded = []; // Permite guardar todos los campos enviados

    // AQUI LA SOLUCIÓN:
    protected $casts = [
        'languages' => 'array',  // <--- ¡CRUCIAL! Evita el error "Array to string conversion"
        'start_date' => 'date',  // Para que Laravel maneje las fechas correctamente
        'end_date' => 'date',
    ];

    // Relaciones
    public function leaderboardParticipants()
    {
        return $this->belongsToMany(User::class, 'leaderboard', 'contest_id', 'user_id')
                    ->withPivot('points', 'rank', 'problems_solved')
                    ->withTimestamps();
    }

    public function registrations()
    {
        return $this->hasMany(ContestRegistration::class, 'contest_id');
    }
}