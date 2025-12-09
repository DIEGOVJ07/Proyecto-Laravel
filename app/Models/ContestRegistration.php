<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContestRegistration extends Model
{
    use HasFactory;

    // 1. IMPORTANTE: Agregamos esto para evitar el error "Table registrations doesn't exist"
    // Esto fuerza a Laravel a usar tu tabla real 'contest_registrations'
    protected $table = 'contest_registrations';

    protected $fillable = [
        'user_id',
        'contest_id',
        'team_name',
        'team_code',
        'is_public',
        'max_members',
        'current_members',
        'team_leader_id',
        'is_team_leader',
        'status',
        'team_size',
        
        // --- NUEVOS CAMPOS PARA CALIFICACIÓN ---
        'score',          // Puntaje total
        'score_details',  // Desglose JSON (Funcionalidad, Diseño...)
        'feedback',       // Comentarios del juez
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_team_leader' => 'boolean',
        
        // --- NUEVOS CASTS ---
        'score' => 'integer',
        'score_details' => 'array', // ¡CRUCIAL! Convierte el JSON de la BD a Array PHP automáticamente
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }

    public function members()
    {
        // Verifica en tu migración 'create_team_members_table' si la llave foránea
        // se llama 'contest_registration_id'. Si es así, esto está perfecto.
        return $this->hasMany(TeamMember::class, 'contest_registration_id');
    }

    public static function generateTeamCode()
    {
        do {
            $code = strtoupper(Str::random(5));
        } while (self::where('team_code', $code)->exists());

        return $code;
    }

    public function isFull()
    {
        return $this->current_members >= $this->max_members;
    }

    public function hasUser($userId)
    {
        if ($this->user_id == $userId) {
            return true;
        }

        return $this->members()->where('user_id', $userId)->exists();
    }

    public function allMembers()
    {
        $leader = User::find($this->user_id);
        $members = $this->members()->with('user')->get()->pluck('user');

        return collect([$leader])->merge($members);
    }
}