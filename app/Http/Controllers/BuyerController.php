<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class BuyerController extends Controller
{
    
    public function editProfile() {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('profile.settings', compact('profileData'));
    }

    public function editPassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.password', compact('profileData'));
    }

    public function editPass(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Old password does not match');
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function editProf(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
        ]);

        // Fetch the currently authenticated user and update their details
        User::whereId(auth()->user()->id)->update([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully');
    }


    public function show($slug) //showing of buyer's profile to any user
    {

         // Get the currently authenticated user
         $user = Auth::user();

         // Check if the user is authenticated
         if (!$user) {
             // Log out the user if the session has expired
             Auth::logout();
             Session::flush(); // Clear the session data
             return redirect()->route('login')->with('message', 'Session expired. Please log in again.');
         }

        $user = User::where('slug', $slug)->firstOrFail();

        return view('profile.profile-buyer', compact('user'));
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
