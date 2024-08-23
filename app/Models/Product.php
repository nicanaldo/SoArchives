<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['ProductName', 'ProductDescription', 'Price', 'old_price', 'Quantity', 'ProductImage', 'UserID'];

    protected $primaryKey = 'ProductID';

    protected $foreignKey = 'UserID';
}
