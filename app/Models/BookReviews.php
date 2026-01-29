<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 'type', 'user_id', 'review', 'rating',
    ];

    protected $appends = ['profile_img'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function getBookReviewsExceptUser($bookId, $userId)
    {
        return static::where('book_id', $bookId)
            ->where('user_id', '!=', $userId);
    }

    public static function getUserReviewForBook($bookId, $userId)
    {
        return static::where([
            'book_id' => $bookId,
            'user_id' => $userId,
        ])->first();
    }

    public static function addForUser($userId, $bookId, $review, $rating)
    {
        return static::firstOrCreate([
            'user_id' => $userId,
            'book_id' => $bookId,
        ], [
            'review' => $review,
            'rating' => $rating,
        ]);
    }

    public static function updateForUser($userId, $bookId, $review, $rating)
    {
        return static::where([
            'user_id' => $userId,
            'book_id' => $bookId,
        ])->update([
            'review' => $review,
            'rating' => $rating,
        ]);
    }

    public static function deleteForUser($userId, $bookId)
    {
        return static::where([
            'user_id' => $userId,
            'book_id' => $bookId,
        ])->delete();
    }

    public function getProfileImgAttribute()
    {
        return $this->user ? $this->user->profile_img : null;
    }

    public function search($query)
    {
        return $this->where('review', 'like', '%'.$query.'%');
    }
}
