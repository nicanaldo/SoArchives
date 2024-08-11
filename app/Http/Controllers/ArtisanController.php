<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function index() {

        // Fetch all users with UserTypeID 2 (sellers)
        $profiles = User::where('UserTypeID', 2)->get();

        $tags = Tag::all();

        // Pass the profiles data to the view
        return view('artisan', compact('profiles', 'tags'));
    }
    
    public function search(Request $request)
    {


        $search = $request->search;

        $profiles = User::where('UserTypeID', 2)
            ->where(function ($query) use ($search) {
                $query->where('fname', 'like', "%$search%")
                    ->orWhere('lname', 'like', "%$search%");
            })
            ->get();

        $tags = Tag::all();

        return view('artisan', compact('profiles', 'search', 'tags'));
        // return redirect(route('artisan'));
        // return redirect(route('artisan'))->with(compact('profiles', 'search'));

    }
}
