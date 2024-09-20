<?php

namespace App\Http\Controllers;

use App\Models\Commend;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{

    public function __construct()
    {
        // Ensure all routes in this controller require the user to be authenticated
        $this->middleware('auth')->except(['show']);
    }

    public function show($slug) //showing of seller profile to any user
    {

        // Fetch the user based on the slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Fetch the products associated with the seller
        $products = Product::where('UserID', $user->id)->get();

        // Fetch the seller's information using the user's ID
        $seller = Seller::where('UserID_Fk', $user->id)->first();

        // Check if seller exists before trying to access its SellerID
        $sellerID = $seller ? $seller->SellerID : null;

        // Commend
        $commend_userID = $user->id;

        $commends = Commend::where('commend_userID', $user->id)->get();
        $commendCount = $commends->count();

        // Fetch feedbacks related to the seller
        $feedbacks_userID = $user->id;
        $feedbacks = Feedback::where('feedback_userID', $user->id)->get();

        // Fetch the seller's selected tags
        $selectedTags = $seller ? $seller->tags()->pluck('name')->toArray() : [];

        // Get the count of feedbacks
        $feedbackCount = $feedbacks->count();

        $activeProducts = Product::where('UserID', $user->id)
            ->where('status', 'active')
            ->paginate(12); // Paginated result for active products

        $archivedProducts = Product::where('UserID', $user->id)
            ->where('status', 'archived')
            ->paginate(12); // Paginated result for archived products

        $trashedProducts = Product::where('UserID', $user->id)
            ->where('status', 'trash')
            ->get(); // Non-paginated result for trashed products

        //Events
        $events = Event::where('Status', 'Approved')
            ->where('UserID', $user->id)
            ->get();

        return view('profile.seller', compact('user', 'products', 'selectedTags', 'seller', 'sellerID','feedbacks_userID', 'commend_userID', 'commendCount', 'feedbacks', 'feedbackCount', 'events', 'activeProducts', 'archivedProducts'));
    }

    
    public function commend(Request $request)
    {
        // Validate the request data
            // Validate the request data
    $validatedData = $request->validate([
        'userID' => 'required|integer',
        'commend_userID' => 'required|integer',
    ]);

    // Check if the commend already exists
    $existingCommend = Commend::where('userID', $validatedData['userID'])
                              ->where('commend_userID', $validatedData['commend_userID'])
                              ->first();

    if ($existingCommend) {
        // If the commend already exists, delete it (uncommend)
        $existingCommend->delete();
        $message = 'Commend removed successfully!';
    } else {
        // If it doesn't exist, create a new commend
        $commend = new Commend();
        $commend->userID = $validatedData['userID'];
        $commend->commend_userID = $validatedData['commend_userID'];
        $commend->save();
        $message = 'Commend submitted successfully!';
    }

    return redirect()->back()->with('message', $message);

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
            'feedback_userID' => 'required|exists:users,id'
        ]);

        // Create a new feedback instance
        $feedback = new Feedback();
        $feedback->userID = auth()->id();
        $feedback->feedback_userID = $request->input('feedback_userID');
        $feedback->rating = $request->input('rating');
        $feedback->feedback = $request->input('feedback');
        $feedback->save();

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    public function updateCoverPhoto(Request $request)
    {
        $request->validate([
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Handle the cover photo upload
        if ($request->hasFile('cover_photo')) {
            $image = $request->file('cover_photo');
            $imageName = time() . '.' . $image->extension();
            $destinationPath = public_path('storage/cover_photos/' . $user->id);


            // Move the uploaded file to the user-specific directory
            $image->move($destinationPath, $imageName);

            // Update the cover_photo column in the user's record
            $user->cover_photo = 'storage/cover_photos/' . $user->id . '/' . $imageName;
            $user->save();

            return response()->json(['success' => true, 'image_path' => asset('storage/' . $user->cover_photo)]);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded.']);
    }


    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user(); // Get the currently authenticated user


        // Handle the profile photo upload
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imageName = time() . '.' . $image->extension();
            $destinationPath = public_path('storage/profile_photos/' . $user->id);

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded file to the user-specific directory
            $image->move($destinationPath, $imageName);

            // Update the profile_photo column in the user's record
            $user->profile_photo = 'storage/profile_photos/' . $user->id . '/' . $imageName;
            $user->save();

            return response()->json(['success' => true, 'image_path' => asset('storage/' . $user->profile_photo)]);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded.']);
    }

    public function deleteProfilePhoto()
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Check if the profile photo exists and delete it
        if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
            unlink(public_path($user->profile_photo));
            $user->profile_photo = null; // Optionally set to default path if preferred
            $user->save();
        }

        return response()->json(['success' => true]);
    }


    public function deleteCoverPhoto()
    {
        $user = Auth::user(); // Assuming you're using authentication

        // Delete the current cover photo if it exists
        if ($user->cover_photo && file_exists(public_path($user->cover_photo))) {
            unlink(public_path($user->cover_photo));
            $user->cover_photo = null;
            $user->save();
        }

        return response()->json(['success' => true]);
    }
}
