<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Event;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dash()
    {

        $user = Auth::user();

        $buyersCount = Buyer::count();
        $sellersCount = Seller::count();
        $eventsCount = Event::count();
        $productsCount = Product::count();
        return view('admin.dash', compact('eventsCount', 'buyersCount', 'sellersCount', 'eventsCount', 'productsCount', 'user' ));
    }
    
    //show data table - EVENT
    public function event()
    {
        $events = Event::get();   

        // Initialize an empty array to store image paths
        $imagePaths = [];

        // Extract image paths from each event
        foreach ($events as $event) {
            $image = $event->EventImage;
            // Store the image path in the $imagePaths array
            $imagePaths[] = $image;
        }

        // Assuming you want to display only the first image for each event
        $image = isset($imagePaths[0]) ? $imagePaths[0] : null;
        
        return view('admin.event', compact('events', 'image'));
    }

    //show data table - BUYER
    public function buyer()
    {
        $users = User::get();   
        $buyers = Buyer::get();
        return view('admin.buyer', compact('users', 'buyers'));
    }

    //show data table - SELLER
    public function seller()
    {
        $users = User::get();   
        $sellers = Seller::get();
        return view('admin.seller', compact('users', 'sellers'));
    }

    // show data table - PRODUCTS
    public function products(Product $product)
    {
        $user = Auth::user();
        $products = Product::get();   

        // Initialize an empty array to store image paths
        $imagePaths = [];

        // Extract image paths from each product
        foreach ($products as $product) {
            $productImages = explode(',', $product->ProductImage);
            // Get the first image path for each product
            $image = isset($productImages[0]) ? $productImages[0] : null;
            // Store the image path in the $imagePaths array
            $imagePaths[] = $image;
        }

        // Assuming you want to display only the first image for each product
        $image = isset($imagePaths[0]) ? $imagePaths[0] : null;
        
        return view('admin.items', compact('products', 'user', 'image'));
    }



    // SELLER MODAL EDIT
    public function get(User $user) {
        return view('admin.seller', ['user' => $user]);
    }

    public function edit(User $users) {
            return view('admin.seller', ['user' => $users]);
        }

    public function update(User $user, Request $request) {
    $data = $request->validate([
        'FName' => 'required',
        'LName' => 'required',
        'email' => 'required',
        'violation', // Add validation for violation
    ]);

    // Retrieve the existing user from the database using the correct primary key column name
    $user = User::findOrFail($user->id);

    // Update the user attributes with the new data
    $user->update($data);

    return redirect()->back();
    }


    
    //BUYER MODAL EDIT
    public function getbuy(User $user) {
        return view('admin.buyer', ['user' => $user]);
    }

    public function editbuy(User $users) {
        return view('admin.buyer', ['user' => $users]);
    }

    public function updatebuy(User $user, Request $request) {
    $data = $request->validate([
        'FName' => 'required',
        'LName' => 'required',
        'email' => 'required',
        'violation', // Add validation for violation
    ]);

    $user = User::findOrFail($user->id);

    $user->update($data);

    return redirect()->back();
    }


    
    //PRODUCT MODAL EDIT
    public function getprod(Product $product) {
        return view('admin.products', ['product' => $product]);
    }

    public function editprod(Product $products) {
        return view('admin.products', ['product' => $products]);
    }

    public function updateprod(Product $product, Request $request) {
    $data = $request->validate([
            'ProductName' => 'required',
            'ProductDescription' => 'required',
            'Price' => 'required',
            'Quantity' => 'required'
    ]);

    $product = Product::findOrFail($product->ProductID);

    $product->update($data);

    return redirect()->back();
    }


    //PRODUCT DELETE 
    public function destroy(Product $product){
        
        // // Delete the product
        $product->delete();

        return redirect()->back();

    
    }

    //EVENT DELETE
    public function destroyevent(Event $event){
        
        // // Delete the product
        $event->delete();

        return redirect()->back();

    }

    //DELETE BUYER
    public function destroybuyer(User $user){
        // Find the buyer associated with the user
        $buyer = Buyer::where('userID_Fk', $user->id)->first();
    
        // Delete the buyer
        if($buyer) {
            $buyer->delete();
        }
    
        // Delete the user
        $user->delete();
    
        return redirect()->back();
    }

    //DELETE SELLER
    public function destroyseller(User $user){
        // Find the buyer associated with the user
        $seller = Seller::where('userID_Fk', $user->id)->first();
    
        // Delete the buyer
        if($seller) {
            $seller->delete();
        }
    
        // Delete the user
        $user->delete();
    
        return redirect()->back();
    }

    //connect with view buyer
    public function view(int $id)    {
        $viewdata = User::findOrFail($id);
        return view('admin.viewbuyer', compact('viewdata'));
    }


    public function delete_event(int $EventID)
    {
        $event = Event::find($EventID);
        $event->delete();
    }

    public function accept_event(int $EventID)
    {
        $acceptevent = Event::find($EventID);
        $acceptevent->Status='Accepted';
        $acceptevent->save();
        return redirect()->back();
    }

    public function reject_event(int $EventID)
    {
        $rejectevent = Event::find($EventID);
        $rejectevent->Status='Rejected';
        $rejectevent->save();
        return redirect()->back();
    }
}
