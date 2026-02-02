<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'profile_img',
        'email_verified_at',
        'first_time',
        'auto_renew_sub',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOAuthUser()
    {
        return $this->google_id !== null;
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function reviews()
    {
        return $this->hasMany(BookReviews::class);
    }

    public function userBookProgresses()
    {
        return $this->hasMany(UserBookProgress::class);
    }

    public function progressForBook($bookId)
    {
        return $this->userBookProgresses()
            ->where('book_id', $bookId)
            ->first();
    }

    public function updateProfileImg($imageName)
    {
        return $this->update(['profile_img' => $imageName]);
    }

    public function UpdateRenewSetting($isRenew)
    {
        return $this->update(['auto_renew_sub' => $isRenew]);
    }

    public static function searchUsers($keyword)
    {
        $keyword = trim($keyword);

        return self::where('id', '!=', auth()->id())->where('name', 'like', "%$keyword%");
    }
}
