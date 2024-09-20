<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'TagsID';
    
    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'seller_tag', 'TagsID', 'SellerID');
    }
}
