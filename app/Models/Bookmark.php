<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_id', 'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function addForUser($userId, $bookId, $type)
    {
        return static::firstOrCreate([
            'user_id' => $userId,
            'book_id' => $bookId,
            'type' => $type,
        ]);
    }

    public static function removeForUser($userId, $bookId, $type)
    {
        return static::where([
            'user_id' => $userId,
            'book_id' => $bookId,
            'type' => $type,
        ])->delete();
    }

    public static function getBookmarksForUser($userId, $type)
    {
        return static::where('user_id', $userId)->where('type', $type)->with('book')->get();
    }
}
