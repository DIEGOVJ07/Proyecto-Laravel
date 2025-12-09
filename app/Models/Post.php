<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'author_id',
        'likes_count',
        'views_count',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relaciones
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_likes')
            ->withTimestamps();
    }

    // Métodos helper
    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function toggleLike(User $user): bool
    {
        if ($this->isLikedBy($user)) {
            $this->likes()->detach($user->id);
            $this->decrement('likes_count');
            return false;
        } else {
            $this->likes()->attach($user->id);
            $this->increment('likes_count');
            return true;
        }
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'Todos') {
            return $query->where('category', $category);
        }
        
        return $query;
    }

    // Auto-generar slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
