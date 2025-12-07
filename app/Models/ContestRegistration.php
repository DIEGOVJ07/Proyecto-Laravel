<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContestRegistration extends Model
{
    use HasFactory;

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
        // NO incluyas team_size, team_members, leader_phone si ya no los usas
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_team_leader' => 'boolean',
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