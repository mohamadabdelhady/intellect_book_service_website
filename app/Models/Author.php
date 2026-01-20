<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','bio','photo_img',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public static function searchAuthors($keyword)
    {
        return self::where('name', 'LIKE', "%$keyword%")
            ->orWhere('About', 'LIKE', "%$keyword%");
    }

    public static function getAuthorById($id)
    {
        return static::where('id', $id)->first();
    }
}
