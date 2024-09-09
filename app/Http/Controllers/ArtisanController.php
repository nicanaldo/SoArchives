<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\SellerTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function index(Request $request) {
        // Fetch all tags
        $tags = Tag::all();
    
        // Display of dropdown tags
        $selectedTags = $request->query('tag');
    
        // Base query to fetch sellers (users with usertypeID 2)
        $artisanQuery = User::where('usertypeID', 2);
    
        // Filter by selected tag
        if ($selectedTags) {
            $artisanQuery->whereHas('sellerProfile.tags', function ($query) use ($selectedTags) {
                $query->where('name', $selectedTags);
            });
        }
    
        // Apply search function
        $search = $request->input('search');
        if ($search) {
            $artisanQuery->where(function ($query) use ($search) {
                $query->where('fname', 'like', "%$search%")
                    ->orWhere('lname', 'like', "%$search%");
            });
        }
    
        // Get the filtered profiles
        $profiles = $artisanQuery->get();
    
        // Initialize an array to store tags for each seller
        $sellersWithTags = [];
    
        // Loop through each profile and fetch tags
        foreach ($profiles as $seller) {
            $sellerProfile = $seller->sellerProfile; // Fetch seller profile through relationship
            $tag = $sellerProfile ? $sellerProfile->tags()->pluck('name')->toArray() : [];
            $sellersWithTags[$seller->id] = $tag;
        }
    
        // Pass the profiles data to the view
        return view('artisan', compact('profiles', 'tags', 'sellersWithTags', 'selectedTags'));
    }
    
}
