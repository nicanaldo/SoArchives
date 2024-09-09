<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function show($slug) //showing of buyer's profile to any user
    {
        $user = User::where('slug', $slug)->firstOrFail();
        
        return view('profile.profile-buyer', compact('user'));
    }
}
