<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Contest;

class Leaderboard extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en tu base de datos
    protected $table = 'leaderboard';

    protected $fillable = [
        'contest_id',
        'user_id',
        'points',
        'problems_solved',
        'rank',
        'is_winner',
        'prize_claimed',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}