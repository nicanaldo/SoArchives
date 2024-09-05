<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index() {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch only the products posted by the authenticated seller
        $products = Product::where('UserID', $user->id)->get();  //eto nadagdag

        $tags = Tag::all();

        $seller = Seller::where('UserID_Fk', auth()->user()->id)->first();

        // Option 1: If using a pivot table
        $selectedTags = $seller->tags()->pluck('name')->toArray();

        // Option 2: If using a comma-separated string in the Tags column
        // $selectedTags = explode(',', $seller->Tags);

        // Pass the products data to the view
        return view('profile.profile-seller', compact('products', 'user', 'tags', 'selectedTags'));
    }

    public function create() {
        return view('profile.profile-seller'); //recheck later dapat ma return siya sa seller profile na products modal
    }


    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'qty' => 'required|numeric',
                'price' => 'required|numeric|regex:/^\d{0,7}(\.\d{1,2})?$/',
                'description' => 'required',
                'prodimg.*' => ['required', 'mimes:jpeg,jpg,png', 'max:5000'] // Allow multiple image types with a maximum size of 2MB
            ]);


            // Get the authenticated user
            $user = Auth::user();

            // Initialize an empty array to store the paths of uploaded images
            $imagePaths = [];

            // Store each uploaded image in a folder specific to the user
            foreach ($request->file('prodimg') as $file) {
                $imagePath = $file->store("public/products/{$user->id}");
                $imagePaths[] = $imagePath;
            }

            // Create a new product record
            $newProduct = Product::create([
                'ProductName' => $data['name'],
                'ProductDescription' => $data['description'],
                'Price' => $data['price'],
                'Quantity' => $data['qty'],
                'ProductImage' => implode(',', $imagePaths), // Store paths as comma-separated values
                'UserID' => $user->id // Associate the product with the authenticated seller
            ]);

            // used try-catch block to handle any exceptions that may occur
            return back()->with('message', 'The post has been added!')->with('type', 'success');


            // the $e variable is to allow you to access information about the exception that occurred,
            // such as the error message, the stack trace, or any other relevant data. This can be useful for logging,
            // debugging, or providing more detailed error messages to the user
        } catch (\Exception $e) {
            return back()->with('message', 'Error creating the product, your file might not be supported')->with('type', 'error');
        }
    }

    public function edit(Product $product) {
        return view('profile.profile-seller', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
{
    try {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve the existing product from the database
        $product = Product::findOrFail($product->ProductID);


         // Compare the existing price with the new price
         $newPrice = $request->input('Pprice');
         if ($product->Price != $newPrice) {
             // If the price has changed, record the old price before updating
             $product->old_price = $product->Price;
             $product->Price = $newPrice;
             $product->price_updated_at = now();
         }

        // Update the product attributes with the new data
        $product->ProductName = $request->input('Pname');
        $product->ProductDescription = $request->input('Pdescription');
        $product->Price = $newPrice;
        $product->Quantity = $request->input('Pqty');

        // Initialize an empty array to store the paths of uploaded images
        $imagePaths = [];

        // Check if new images are uploaded
        if ($request->hasFile('PImage')) {
            // Store each uploaded image in a folder specific to the user
            foreach ($request->file('PImage') as $file) {
                $imagePath = $file->store("public/products/{$user->id}");
                $imagePaths[] = $imagePath;
            }

            // Update the product's image paths
            $product->ProductImage = implode(',', $imagePaths); // Store paths as comma-separated values
        }

        // Save the updated product
        if ($product->save()) {
            return back()->with('message', 'Product Updated Successfully')->with('type', 'success');
        } else {
            return back()->with('message', 'Error updating the product')->with('type', 'error');
        }
    } catch (\Exception $e) {
        // Log the exception or handle it in a more appropriate way
        error_log('Error updating product: ' . $e->getMessage());
        return back()->with('message', 'An error occurred while updating the product')->with('type', 'error');
    }
}


    public function destroy(Product $product){

        try {
            // Delete the product
            if ($product->delete()) {
                return back()->with('message', 'Product deleted successfully')->with('type', 'success');
            } else {
                return back()->with('message', 'Error deleting the product')->with('type', 'error');
            }
        } catch (\Exception $e) {
            // the $e variable is to allow you to access information about the exception that occurred,
            // such as the error message, the stack trace, or any other relevant data. This can be useful for logging,
            // debugging, or providing more detailed error messages to the user
            return back()->with('message', 'Error deleting the product, please try again later')->with('type', 'error');
        }


    }

    public function calculateTotalPrice(Request $request)
    {
        // Get the selected product IDs from the form submission
        $selectedProductIDs = $request->input('selected_products', []);

        // Fetch the products based on the selected IDs
        $selectedProducts = Product::whereIn('ProductID', $selectedProductIDs)->get();

        // Calculate the total price
        $totalPrice = $selectedProducts->sum('Price');

        // Pass the total price to the view
        return view('total-price', ['totalPrice' => $totalPrice]);
    }


    public function search(Request $request)
    {

        $user = Auth::user();

        $search = $request->search;

        $products = Product::where('UserID', $user->id)
            ->where('ProductName', 'like', "%$search%")->get();

        return view('profile.profile-seller', compact('products', 'search', 'user'));
    }

    public function storeTags(Request $request)
    {
        // Validate the input (if necessary)
        $request->validate([
            'tags' => 'required|array',
        ]);

        // Assuming you have the seller's ID stored in the session or passed as a hidden input
        $seller = Seller::where('UserID_Fk', auth()->user()->id)->first();

        // Clear existing tags
        DB::table('seller_tag')->where('SellerID', $seller->SellerID)->delete();

        // Insert new tags
        foreach ($request->input('tags') as $tagName) {
            $tag = Tag::where('name', $tagName)->first();
            DB::table('seller_tag')->insert([
                'SellerID' => $seller->SellerID,
                'TagsID' => $tag->TagsID,
            ]);
        }

        return redirect()->back()->with('success', 'Tags updated successfully!');
    }

}

