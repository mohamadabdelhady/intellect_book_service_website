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

    public function seatchAuthors($keyword)
    {
        return $this->where('name', 'LIKE', "%$keyword%")
            ->orWhere('bio', 'LIKE', "%$keyword%");
    }

    public static function getAuthorById($id)
    {
        return static::where('id', $id)->first();
    }
}
