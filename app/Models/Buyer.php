<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $primaryKey = 'BuyerID'; 

    protected $fillable = ['Violation', 'UserID_Fk']; 

    protected $foreignKey = 'UserID_Fk';
}
