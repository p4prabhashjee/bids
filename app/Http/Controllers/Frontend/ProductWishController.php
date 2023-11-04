<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;


class ProductWishController extends Controller
{
    public function addToWishlist(Request $request, Product $product)
    {
        if (Auth::check()) {
            if (!$request->user()->wishlist->contains($product)) {
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::id();
                $wishlist->product_id = $product->id;
                $wishlist->save();

                // You can also add additional logic to handle the response, e.g., return a success message
                return response()->json(['message' => 'Product added to your wishlist.']);
            }
        }

        return response()->json(['error' => 'You must be logged in to add products to your wishlist.'], 403);
    }
}
