<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'author_id', 'text', 'cover_img', 'rating', 'type', 'narrator', 'category_id', 'file_path',
    ];

    protected $appends = ['is_bookmarked', 'stored_name', 'author_name'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function reviews()
    {
        return $this->hasMany(BookReviews::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function userProgresses()
    {
        return $this->hasMany(UserBookProgress::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeOfCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeSorted($query, $sort)
    {
        return match ($sort) {
            'rate' => $query->orderByDesc('rating'),
            'newest' => $query->orderByDesc('created_at'),
            'oldest' => $query->orderBy('created_at'),
            default => $query,
        };
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->bookmarks()->where('user_id', auth()->id())->exists();
    }

    public function getStoredNameAttribute()
    {
        return 'id_'.$this->id.'_'.$this->name;
    }

    public function scopeOfAuthor($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    public static function searchBooks($keyword)
    {
        $keyword = trim($keyword);

        return self::where('name', 'LIKE', "%{$keyword}%")
            ->orWhereHas('author', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            });
    }

    public function getAuthorNameAttribute()
    {
        return $this->author ? $this->author->name : null;
    }
}
