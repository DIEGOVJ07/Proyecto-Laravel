<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contest_id',
        'team_name',
        'team_size',
        'team_members',
        'leader_phone',
        'status',
    ];

    protected $casts = [
        'team_members' => 'array',
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