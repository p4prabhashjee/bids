<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auctiontype;
use App\Models\Category;
use App\Models\Helpsupport;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verifyOTP', 'forgotpassword', 'resetpassword']]);
    }
    public function homepage(Request $request)
    {
        try {

            $category_id = $request->input('category_id');
            // Get the search query from the request
            $searchQuery = $request->input('search_query');

            $names = Category::where('status', 1)->pluck('name');
            $namesArray = $names->toArray();
            $productsQuery = Product::with(['auctionType', 'galleries']);
            if (!empty($category_id)) {
                $productsQuery->where('category_id', $category_id);
            }
            // Perform a search if a search query is provided
            if (!empty($searchQuery)) {
                $productsQuery->where(function ($query) use ($searchQuery) {
                    $query->where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
                });
            }
            $products = $productsQuery->get();

            $formattedProducts = [];
            foreach ($products as $product) {
                $auctionTypeName = $product->auctionType->name;

                // Calculate the time remaining
                $auctionStartDateTime = Carbon::parse($product->auction_start_date . ' ' . $product->auction_start_time);
                $now = Carbon::now();
                $timeRemaining = $auctionStartDateTime->diffForHumans($now, [
                    'parts' => 5,
                    'syntax' => Carbon::DIFF_ABSOLUTE,
                ]);

                // Create a new key if it doesn't exist
                if (!isset($formattedProducts[$auctionTypeName])) {
                    $formattedProducts[$auctionTypeName] = [];
                }

                // Add product details to the corresponding auction type key
                $formattedProducts[$auctionTypeName][] = [
                    'title' => $product->title,
                    'image_path' => $product->galleries->first()->image_path,
                    'reserved_price' => $product->reserved_price,
                    'time_remaining' => $timeRemaining,
                    // 'current_bid' => $product->bids->max('bid_amount'),
                ];
            }

            return response()->json([
                'ResponseCode' => 200,
                'Status' => 'true',
                'Message' => 'Data Retrived Successfully',
                'data' => [
                    'categories' => $namesArray,
                    'products' => $formattedProducts,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'ResponseCode' => 500,
                'Status' => 'False',
                'Message' => $e->getMessage(),
            ], 500);
        }
    }

    //  product detail api
    public function getProductDetail(Request $request)
    {
        try {
            $rules = [
                'product_id' => 'required|exists:products,id',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return response()->json([
                    'ResponseCode' => 422,
                    'Status' => 'False',
                    'Message' => $firstErrorMessage,
                ], 422);
            }
            $productId = $request->input('product_id');
            $product = Product::with(['auctionType', 'galleries'])
                ->where('id', $productId)
                ->first();

            if (!$product) {
                return response()->json([
                    'ResponseCode' => 422,
                    'Status' => 'false',
                    'Message' => 'Product not found',
                ], 422);
            }

            // Calculate the time remaining for the auction
            $auctionStartDateTime = Carbon::parse($product->auction_start_date . ' ' . $product->auction_start_time);
            $now = Carbon::now();
            $timeRemaining = $auctionStartDateTime->diffForHumans($now, [
                'parts' => 5,
                'syntax' => Carbon::DIFF_ABSOLUTE,
            ]);

            // Fetch product specifications for the product

            $productSpecifications = Specification::where('product_id', $productId)
                ->select('name', 'value')
                ->get();

            // Prepare the product detail response
            $productDetail = [
                'title' => $product->title,
                'description' => html_entity_decode(strip_tags($product->description)),
                'image_paths' => $product->galleries->pluck('image_path')->toArray(),
                'reserved_price' => $product->reserved_price,
                'time_remaining' => $timeRemaining,
                // 'auction_type' => $product->auctionType->name,
                'product_specifications' => $productSpecifications,
            ];

            return response()->json([
                'ResponseCode' => 200,
                'Status' => 'true',
                'Message' => 'Product details retrieved successfully',
                'data' => $productDetail,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'ResponseCode' => 500,
                'Status' => 'false',
                'Message' => $e->getMessage(),
            ], 500);
        }
    }

    // add to wishliist api.
    public function addToWishlist(Request $request)
    {
        $productId = $request->input('product_id');
        $user = Auth::user();
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'ResponseCode' => 422,
                'Status' => 'false',
                'Message' => 'Product not found',
            ], 422);
        }

        // Check if the product is already in the wishlist
        if ($user->wishlists()->where('product_id', $productId)->exists()) {
            return response()->json([
                'ResponseCode' => 422,
                'Status' => 'false',
                'Message' => 'Product is already in the wishlist',
            ], 422);
        }

        // Add the product to the wishlist
        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->product_id = $productId;
        $wishlist->save();

        return response()->json([
            'ResponseCode' => 200,
            'Status' => 'true',
            'Message' => 'Product added to wishlist',
        ], 200);
    }
// my wishlist api
    public function myWishlist()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'ResponseCode' => 400,
                'Status' => 'false',
                'Message' => 'Unauthorized',
            ], 400);
        }

        $wishlist = $user->wishlists()->with('product')->get();
        $formattedProducts = [];

        foreach ($wishlist as $item) {
            $product = $item->product;

            $auctionStartDateTime = Carbon::parse($product->auction_start_date . ' ' . $product->auction_start_time);
            $now = Carbon::now();
            $timeRemaining = $auctionStartDateTime->diffForHumans($now, [
                'parts' => 5,
                'syntax' => Carbon::DIFF_ABSOLUTE,
            ]);

            $auctionTypeName = $product->auction_type;

            // Create a new key if it doesn't exist
            if (!isset($formattedProducts[$auctionTypeName])) {
                $formattedProducts[$auctionTypeName] = [];
            }

            // Add product details to the corresponding auction type key
            $formattedProducts[$auctionTypeName][] = [
                'title' => $product->title,
                'image_path' => $product->galleries->first()->image_path,
                'reserved_price' => $product->reserved_price,
                'time_remaining' => $timeRemaining,
                // 'current_bid' => $product->bids->max('bid_amount'),
            ];
        }

        return response()->json([
            'ResponseCode' => 200,
            'Status' => 'true',
            'Message' => 'My wishlist',
            'data' => $formattedProducts,
        ], 200);
    }

    // help & support api.

    public function helpsupport(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:help_support,email',
                'mobile' => 'required|string|max:20',
                'description' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return response()->json([
                    'ResponseCode' => 422,
                    'Status' => 'False',
                    'Message' => $firstErrorMessage,
                ], 422);
            }

            // Get the authenticated user's ID
            $userId = auth()->user()->id;

            $help = new Helpsupport([
                'user_id' => $userId, // Store the user's ID
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
            ]);

            $help->save();

            return response()->json([
                'ResponseCode' => 200,
                'Status' => 'true',
                'Message' => 'Enquiry Submitted Successfully',
                'data' => $help,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'ResponseCode' => 500,
                'Status' => 'False',
                'Message' => $e->getMessage(),
            ], 500);
        }
    }

    // remove from wishlist

    public function removeFromWishlist(Request $request)
    {
        $productId = $request->input('product_id');
        $user = Auth::user();

        $wishlistItem = $user->wishlists()->where('product_id', $productId)->first();

        if (!$wishlistItem) {
            return response()->json([
                'ResponseCode' => 422,
                'Status' => 'false',
                'Message' => 'Product is not in the wishlist',
            ], 422);
        }

        // Remove the product from the wishlist
        $wishlistItem->delete();

        return response()->json([
            'ResponseCode' => 200,
            'Status' => 'true',
            'Message' => 'Product removed from wishlist',
        ], 200);
    }

}
