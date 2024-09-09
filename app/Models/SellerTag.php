<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerTag extends Model
{
    use HasFactory;

    protected $table = 'seller_tag';

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'SellerID', 'SellerID');
    }

}
