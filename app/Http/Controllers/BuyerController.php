<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function show(User $user) //pag show to ng profile ng seller sa end ng buyer
    {
        // Fetch the seller's information using the user's ID
        $seller = Buyer::where('UserID_Fk', $user->id)->first();
        
        return view('profile.profile-buyer', compact('seller'));
    }
}
