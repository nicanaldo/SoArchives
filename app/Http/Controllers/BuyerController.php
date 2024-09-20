<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Commend;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BuyerController extends Controller
{
    public function show() //showing of buyer's profile to any user
    {
        $user = Auth::user();

        // Fetch feedbacks related to the seller
        $feedbacks_userID = $user->id;
        $feedbacks = Feedback::where('feedback_userID', $user->id)->get();

        // Get the count of feedbacks
        $feedbackCount = $feedbacks->count();
        
        return view('profile.profile-buyer', compact('user', 'feedbacks', 'feedbackCount'));
    }

    public function profile($slug) //showing of buyer's profile to any user
    {
        $user = User::where('slug', $slug)->firstOrFail();

        // dd($user);

        // Commend
        $commend_userID = $user->id;

        // Get the count of commend 
        $commends = Commend::where('commend_userID', $user->id)->get();
        $commendCount = $commends->count();

        // Fetch feedbacks related to the buyer
        $feedbacks_userID = $user->id;
        $feedbacks = Feedback::where('feedback_userID', $user->id)->get();

        // Get the count of feedbacks
        $feedbackCount = $feedbacks->count();
        
        return view('profile.buyer', compact('user', 'commend_userID', 'commendCount', 'feedbacks_userID', 'feedbacks', 'feedbackCount'));
    }

    public function commend(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'userID' => 'required|integer',
            'commend_userID' => 'required|integer',
        ]);

        // Create a new commend record
        $commend = new Commend();
        $commend->userID = $validatedData['userID'];
        $commend->commend_userID = $validatedData['commend_userID'];
        $commend->save();

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

    public function deleteProfilePhoto()
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Check if the profile photo exists and delete it
        if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
            unlink(public_path($user->profile_photo));
            $user->profile_photo = null; // Optionally set to default path if preferred
            $user->save();
        }

        return response()->json(['success' => true, 'image_path' => asset('images/defuser.png')]);
    }


    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Check if the user is authenticated
        if (!$user) {
            // Log out the user if the session has expired
            Auth::logout();
            Session::flush(); // Clear the session data
            return redirect()->route('login')->with('message', 'Session expired. Please log in again.');
        }

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
            $user->profile_photo = 'profile_photos/' . $user->id . '/' . $imageName;
            $user->save();

            return response()->json(['success' => true, 'image_path' => asset('storage/' . $user->profile_photo)]);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded.']);
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
