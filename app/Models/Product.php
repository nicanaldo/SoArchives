<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['ProductName', 'ProductDescription', 'Price', 'old_price', 'Quantity', 'ProductImage', 'UserID'];

    protected $primaryKey = 'ProductID';

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class, 'product_id');
    }

    public function likedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }
}

