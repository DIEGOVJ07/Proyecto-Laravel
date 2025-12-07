<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'contest_registration_id',
        'user_id',
        'status',
    ];

    /**
     * Relación: Un miembro pertenece a un equipo
     */
    public function team()
    {
        return $this->belongsTo(ContestRegistration::class, 'contest_registration_id');
    }

    /**
     * Relación: Un miembro es un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}