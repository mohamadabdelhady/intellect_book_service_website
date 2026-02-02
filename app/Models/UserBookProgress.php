<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_id', 'progress', 'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function setProgressForUser($userId, $bookId, $progress)
    {
        return static::updateOrCreate(
            [
                'user_id' => $userId,
                'book_id' => $bookId,
            ],
            [
                'progress' => $progress,
            ]
        );
    }

    public static function getProgressForUser($userId, $bookId)
    {
        return static::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first()
            ?->progress;
    }
}
