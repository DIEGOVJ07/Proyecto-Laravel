<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'leaderboard';

    protected $fillable = [
        'user_id',
        'total_points',
        'contests_won',
        'problems_solved',
        'global_ranking',
        'country_code',
        'trend',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTrendIcon()
    {
        return match($this->trend) {
            'up' => '<i class="fas fa-arrow-up text-green-400"></i>',
            'down' => '<i class="fas fa-arrow-down text-red-400"></i>',
            default => '<span class="text-gray-400">—</span>',
        };
    }

    public function getRankIcon()
    {
        return match($this->global_ranking) {
            1 => '👑',
            2 => '🥈',
            3 => '🥉',
            default => '#' . $this->global_ranking,
        };
    }
}