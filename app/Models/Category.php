<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'banner_img',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public static function searchCategories($query)
    {
        return self::where('name', 'LIKE', "%{$query}%");
    }
}
