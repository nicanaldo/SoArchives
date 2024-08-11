<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $primaryKey = 'SellerID'; 

    protected $fillable = ['Course', 'Year', 'Birthdate', 'StudentNo', 'UserID_Fk', 'Consent']; 

    protected $foreignKey = 'UserID_Fk';
}
