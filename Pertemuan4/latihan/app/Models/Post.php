<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user', 'category'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //Relasi belongsTo untuk User (Author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) => $query->where('title', 'like', '%' . $search
            . '%')
        );

        $query->when(
            $filters['author'] ?? false,
            fn($query, $author) => $query->whereHas('user', fn($query) => 
            $query->where('username', $author))
        );
    }
}
