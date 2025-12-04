<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'difficulty',
        'duration',
        'participants',
        'prize',
        'languages',
        'start_date',
        'end_date',
        'rules',
        'requirements',
        'min_team_members',
        'max_team_members',
    ];

    protected $casts = [
        'languages' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'prize' => 'decimal:2',
    ];

    public function registrations()
    {
        return $this->hasMany(ContestRegistration::class);
    }


    /**
 * Relación: Un concurso puede tener muchos jueces
 */
public function judges()
{
    return $this->belongsToMany(Judge::class, 'contest_judge')
                ->withPivot('role')
                ->withTimestamps();
}


}