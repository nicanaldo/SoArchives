<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function show(User $user) //pag show to ng profile ng seller sa end ng buyer
    {
        // Fetch the products associated with the seller
        $products = Product::where('UserID', $user->id)->get();

        // Fetch the seller's information using the user's ID
        $seller = Seller::where('UserID_Fk', $user->id)->first();

        // Check if seller exists before trying to access its SellerID
        $sellerID = $seller ? $seller->SellerID : null;

        // Fetch feedbacks related to the seller
        $feedbacks = Feedback::where('sellerID', $seller->SellerID)->get();

        // Fetch the seller's selected tags
        $selectedTags = $seller ? $seller->tags()->pluck('name')->toArray() : [];

        // Get the count of feedbacks
        $feedbackCount = $feedbacks->count();
        
        return view('profile.seller', compact('user', 'products', 'selectedTags', 'seller', 'sellerID', 'feedbacks', 'feedbackCount'));
    }

    public function submitRating(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'You must be logged in to submit feedback.');
        }

        // Validate the input data
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'feedback' => 'nullable|string',
            'sellerID' => 'required|exists:sellers,sellerID'
        ]);

        // Create a new feedback instance
        $feedback = new Feedback();
        $feedback->userID = auth()->id();
        $feedback->sellerID = $request->input('sellerID');
        $feedback->rating = $request->input('rating');
        $feedback->feedback = $request->input('feedback');
        $feedback->save();

        return redirect()->back()->with('success', 'Feedback submitted successfully!');

    }
}
