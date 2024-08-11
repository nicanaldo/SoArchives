<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show(User $user) //pag show to ng profile ng seller sa end ng buyer
    {
        $products = Product::where('UserID', $user->UserID)->get();
        return view('profile.seller', compact('user', 'products'));
    }
}
