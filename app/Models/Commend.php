<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commend extends Model
{
    use HasFactory;

    protected $table = 'commends';

    protected $fillable = [
        'userID',
        'commend_userID',
    ];
}
