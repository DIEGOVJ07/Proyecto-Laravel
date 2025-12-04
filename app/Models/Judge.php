<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialty',
        'institution',
        'experience_years',
        'bio',
        'certification_level',
        'is_active',
        'photo_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'experience_years' => 'integer',
    ];

    /**
     * Relación: Un juez puede estar en muchos concursos
     */
    public function contests()
    {
        return $this->belongsToMany(Contest::class, 'contest_judge')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Obtener el badge de certificación con color
     */
    public function getCertificationBadge()
    {
        return match($this->certification_level) {
            'Expert' => '<span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 border border-yellow-500 rounded-full text-xs font-bold">🏆 Expert</span>',
            'Senior' => '<span class="px-3 py-1 bg-purple-500/20 text-purple-400 border border-purple-500 rounded-full text-xs font-bold">⭐ Senior</span>',
            'Junior' => '<span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500 rounded-full text-xs font-bold">🎯 Junior</span>',
            default => '<span class="px-3 py-1 bg-gray-500/20 text-gray-400 border border-gray-500 rounded-full text-xs font-bold">Sin nivel</span>',
        };
    }

    /**
     * Obtener avatar inicial
     */
    public function getInitials()
    {
        $words = explode(' ', $this->name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }
}