<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id'; 

    protected $table = 'users';

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'usertypeID',
        'remember_token',
        'is_activated',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($user) {
    //         if (empty($user->slug)) {
    //             $user->slug = Str::slug($user->fname . ' ' . $user->lname);
    //         }
    //     });
    // }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if (empty($user->slug)) {
                $user->slug = Str::slug($user->fname . ' ' . $user->lname);
            }
            // Ensure slug is unique if necessary
            $originalSlug = $user->slug;
            $count = User::where('slug', $originalSlug)->count();
            if ($count > 0) {
                $user->slug = $originalSlug . '-' . ($count + 1);
            }
        });
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'seller_tag', 'SellerID', 'TagsID');
    }
    
    public function sellerProfile() {
        return $this->hasOne(Seller::class, 'UserID_Fk', 'id');
    }    
    

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }

    public function isAdmin()
    {
        return $this->UserTypeID === 1; 
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }


    public function events()
    {
        return $this->hasMany(Event::class, 'UserID');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
