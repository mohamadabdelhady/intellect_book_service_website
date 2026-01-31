<?php

namespace App\Models;

use App\Enums\AdminRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'role' => AdminRole::class,
    ];

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public static function searchAdmins($keyword)
    {
        $keyword = trim($keyword);

        return self::where('id', '!=', auth('admin')->id())->where('name', 'like', "%$keyword%");
    }
}
