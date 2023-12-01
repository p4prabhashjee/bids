<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auctiontype;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Helpsupport;
use App\Models\Product;
use App\Models\Project;
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
    // categories api

    public function categories(Request $request)
    {
        try {
            $search = $request->input('search');

            $query = Category::where('status', 1)
                ->select('id', 'name', 'image_path');

            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }

            $categories = $query->get();

            foreach ($categories as $cat) {
                $cat->image_path = asset("img/users/" . $cat->image_path);
            }
            return response()->json([
                'ResponseCode' => 200,
                'Status' => 'true',
                'Message' => 'Data Retrived Successfully',
                'data' => [
                    'categories' => $categories,
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

    // homepage api
    public function homepage(Request $request)
    {
        try {
            $banners = Banner::where('status', 1)->select('id', 'title', 'description', 'image_path')->get();
            foreach ($banners as $banner) {
                $banner->description = strip_tags($banner->description);
                $banner->image_path = asset("img/users/" . $banner->image_path);
            }

            $categories = Category::where('status', 1)
                ->select('id', 'name', 'image_path')
                ->get();
            foreach ($categories as $cat) {
                $cat->image_path = asset("img/users/" . $cat->image_path);
            }

            $projects = Project::where('is_trending', 1)->with('auctionType')
                ->where('status', 1)
                ->get();

            $categorizedProjects = [];
            foreach ($projects as $project) {
                $type = $project->auctionType->name;

                if (!isset($categorizedProjects[$type])) {
                    $categorizedProjects[$type] = [];
                }

                $categorizedProjects[$type][] = [
                    'id' => $project->id,
                    'title' => $project->name,
                    'image_path' => asset("img/projects/" . $project->image_path),
                    'start_date_time' => Carbon::parse($project->start_date_time)->format('F j, h:i A'),
                    'auction_type_id' => $project->auctionType->id,
                ];
            }
            $productauction = AuctionType::with(['products' => function ($query) {
                $query->where('status', 1)
                    ->where('is_popular', 1);
            }, 'galleries'])->where('status', 1)->get();

            $popular = [];

            foreach ($productauction as $auctionType) {
                $auctionTypeName = $auctionType->name;
                $auctionTypeIcon = '';
                if ($auctionTypeName === 'Private') {
                    $auctionTypeIcon = asset('auctionicon/private_icon.png');
                } elseif ($auctionTypeName === 'Timed') {
                    $auctionTypeIcon = asset("auctionicon/time.png");
                } elseif ($auctionTypeName === 'Live') {
                    $auctionTypeIcon = asset("auctionicon/live.png");
                }

                $loggedInUser = Auth::user();
                foreach ($auctionType->products as $product) {
                    $id = $product->id;
                    $lotNumber = $product->lot_no;
                    $reserved = $product->reserved_price;
                    $productTitle = $product->title;
                    $productDescription = strip_tags($product->description);
                    $auctionEndDate = "";

                    if ($auctionTypeName === 'Private' || $auctionTypeName === 'Timed') {
                        $timestamp = strtotime($product->auction_end_date);
                        $milliseconds = $timestamp * 1000;
                        $auctionEndDate = $milliseconds;
                    }

                    $popular[] = [
                        'auction_type_name' => $auctionTypeName,
                        'auction_type_icon' => $auctionTypeIcon,
                        'product_id' => $id,
                        'image_path' => $product->galleries->first()->image_path,
                        'reserved_price' => $reserved,
                        'lot_no' => $lotNumber,
                        'product_title' => $productTitle,
                        'product_description' => $productDescription,
                        'auction_end_date' => $auctionEndDate,
                        'current_bid' => '',
                        'is_wishlist' => $loggedInUser ? $loggedInUser->wishlists->contains('product_id', $product->id) : false,
                    ];
                }
            }
            return response()->json([
                'ResponseCode' => 200,
                'Status' => 'true',
                'Message' => 'Data Retrived Successfully',
                'data' => [
                    'banners' => $banners,
                    'categories' => $categories,
                    'projects' => $categorizedProjects,
                    'popular' => $popular,
                    'most_bids' => '',
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

    // product list api based on project_id

    public function productlistbasedproject(Request $request)
    {
        try {
            $rules = [
                'project_id' => 'required|exists:projects,id',
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

            $project = Project::find($request->project_id);
            if (!$project) {
                return response()->json([
                    'ResponseCode' => 404,
                    'Status' => 'False',
                    'Message' => 'Project not found',
                ], 404);
            }

            $auctionType = AuctionType::find($project->auction_type_id);

            $productsQuery = Product::where('project_id', $request->project_id);

            // Search based on product title if a search term is provided
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;
                $productsQuery->where('title', 'LIKE', '%' . $searchTerm . '%');
            }

            $products = $productsQuery->get();
            $loggedInUser = Auth::user();

            $productList = [];
            foreach ($products as $product) {
                $auctionEndDate = null;

                if ($auctionType && ($auctionType->name === 'Private' || $auctionType->name === 'Timed')) {
                    $timestamp = strtotime($product->auction_end_date);
                    $milliseconds = $timestamp * 1000;
                    $auctionEndDate = $milliseconds;
                }
                $productImage = null;
                if ($product->galleries->isNotEmpty()) {
                    $productImage = $product->galleries->first()->image_path;
                }
                $productList[] = [
                    'id' => $product->id,
                    'lot_no' => $product->lot_no,
                    'title' => $product->title,
                    'product_image' => $productImage,
                    'reserved_price' => $product->reserved_price,
                    'auction_end_date' => $auctionEndDate,
                    'is_wishlist' => $loggedInUser ? $loggedInUser->wishlists->contains('product_id', $product->id) : false,
                    'current_bid' => '',
                ];
            }
            $auctionTypeName = $auctionType->name ?? null;
            $auctionTypeIcon = '';
            if ($auctionTypeName === 'Private') {
                $auctionTypeIcon = asset('auctionicon/private_icon.png');
            } elseif ($auctionTypeName === 'Timed') {
                $auctionTypeIcon = asset('auctionicon/time.png');
            } elseif ($auctionTypeName === 'Live') {
                $auctionTypeIcon = asset('auctionicon/live.png');
            }
            return response()->json([
                'ResponseCode' => 200,
                'Status' => 'True',
                'Message' => 'Data Retrieved Successfully',
                'data' => [
                    'project_id' => $project->id,
                    'project_name' => $project->name,
                    'project_start_date' => Carbon::parse($project->start_date_time)->format('F j, h:i A'),
                    'auction_type_name' => $auctionType->name ?? null,
                    'auction_type_icon' => $auctionTypeIcon,
                    'products' => $productList,
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
    // projectlist based on auctiontype
    public function projectlistbasedauction(Request $request)
    {
        try {
            $rules = [
                'auction_type_id' => 'required|exists:auction_types,id',
                'project_name' => '',
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

            $auctionType = AuctionType::find($request->auction_type_id);
            if (!$auctionType) {
                return response()->json([
                    'ResponseCode' => 404,
                    'Status' => 'False',
                    'Message' => 'Auction type not found',
                ], 404);
            }

            $projectsQuery = Project::where('auction_type_id', $auctionType->id);

            // Add project name search if provided in the request
            if ($request->has('project_name')) {
                $projectsQuery->where('name', 'like', '%' . $request->project_name . '%');
            }

            $projects = $projectsQuery->get();

            $auctionTypeName = $auctionType->name ?? null;
            $auctionTypeIcon = '';

            if ($auctionTypeName === 'Private') {
                $auctionTypeIcon = asset('auctionicon/private_icon.png');
            } elseif ($auctionTypeName === 'Timed') {
                $auctionTypeIcon = asset('auctionicon/time.png');
            } elseif ($auctionTypeName === 'Live') {
                $auctionTypeIcon = asset('auctionicon/live.png');
            }

            $responseData = [
                'ResponseCode' => 200,
                'Status' => 'True',
                'Message' => 'Data Retrieved Successfully',
                'data' => [],
            ];

            foreach ($projects as $project) {
                $responseData['data'][] = [
                    'id' => $project->id,
                    'title' => $project->name,
                    'image_path' => asset("img/projects/" . $project->image_path),
                    'start_date_time' => Carbon::parse($project->start_date_time)->format('F j, h:i A'),
                    'auction_type_name' => $auctionType->name ?? null,
                    'auction_type_icon' => $auctionTypeIcon,
                ];
            }

            return response()->json($responseData, 200);

        } catch (\Exception $e) {
            return response()->json([
                'ResponseCode' => 500,
                'Status' => 'False',
                'Message' => $e->getMessage(),
            ], 500);
        }
    }

    // projectlistbased category api
    public function projectlistbasedcategory(Request $request)
    {
        try {
            $rules = [
                'category_id' => 'required|exists:categories,id',
                'project_name' => 'nullable',
                'auction_type_name' => 'nullable',
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

            $cat = Category::find($request->category_id);
            if (!$cat) {
                return response()->json([
                    'ResponseCode' => 404,
                    'Status' => 'False',
                    'Message' => 'Category not found',
                ], 404);
            }

            $projectsQuery = Project::where('category_id', $cat->id);

            // Add project name search if provided in the request
            if ($request->has('project_name') && !empty($request->project_name)) {
                $projectsQuery->where('name', 'like', '%' . $request->project_name . '%');
            }
            // Filter by auction_type_name if provided in the request
            // if ($request->has('auction_type_name') && !empty($request->auction_type_name)) {
            //     $auctionType = AuctionType::where('name', $request->auction_type_name)->first();
            //     if ($auctionType) {
            //         $projectsQuery->where('auction_type_id', $auctionType->id);
            //     }
            // }
            if ($request->has('auction_type_name') && !empty($request->auction_type_name)) {
                $auctionTypeNames = explode(',', $request->auction_type_name);

                $auctionTypeIds = AuctionType::whereIn('name', $auctionTypeNames)->pluck('id')->toArray();

                if (!empty($auctionTypeIds)) {
                    $projectsQuery->whereIn('auction_type_id', $auctionTypeIds);
                }
            }

            $projects = $projectsQuery->get();
            $responseData = [
                'ResponseCode' => 200,
                'Status' => 'True',
                'Message' => 'Data Retrieved Successfully',
                'data' => [],
            ];

            foreach ($projects as $project) {
                $auctionType = AuctionType::find($project->auction_type_id);

                $auctionTypeName = $auctionType ? $auctionType->name : null;
                $auctionTypeIcon = '';

                if ($auctionTypeName === 'Private') {
                    $auctionTypeIcon = asset('auctionicon/private_icon.png');
                } elseif ($auctionTypeName === 'Timed') {
                    $auctionTypeIcon = asset('auctionicon/time.png');
                } elseif ($auctionTypeName === 'Live') {
                    $auctionTypeIcon = asset('auctionicon/live.png');
                }
                $responseData['data'][] = [
                    'id' => $project->id,
                    'title' => $project->name,
                    'image_path' => asset("img/projects/" . $project->image_path),
                    'start_date_time' => Carbon::parse($project->start_date_time)->format('F j, h:i A'),
                    'auction_type_name' => $auctionTypeName,
                    'auction_type_icon' => $auctionTypeIcon,
                ];
            }

            return response()->json($responseData, 200);

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
            $auctionType = AuctionType::find($product->auction_type_id);
            $now = Carbon::now();
            $auctionEndDate = null;
            if ($auctionType && ($auctionType->name === 'Private' || $auctionType->name === 'Timed')) {
                $timestamp = strtotime($product->auction_end_date);
                $milliseconds = $timestamp * 1000;
                $auctionEndDate = $milliseconds;
            }
            $auctionTypeName = $auctionType->name ?? null;
            $auctionTypeIcon = '';

            if ($auctionTypeName === 'Private') {
                $auctionTypeIcon = asset('auctionicon/private_icon.png');
            } elseif ($auctionTypeName === 'Timed') {
                $auctionTypeIcon = asset('auctionicon/time.png');
            } elseif ($auctionTypeName === 'Live') {
                $auctionTypeIcon = asset('auctionicon/live.png');
            }

            $loggedInUser = Auth::user();
            $project = Project::find($product->project_id);

            if ($project) {
                $projectName = $project->name ?? null;
                $projectStartDate = $project->start_date_time ?? null;

                $productDetail['project_name'] = $projectName;
                $productDetail['project_start_date_time'] = $projectStartDate;
            } else {

                $productDetail['project_name'] = null;
                $productDetail['project_start_date_time'] = null;
            }

            $productDetail = [
                'id' => $product->id,
                'lot_no' => $product->lot_no,
                'title' => $product->title,
                'description' => html_entity_decode(strip_tags($product->description)),
                'image_paths' => $product->galleries->pluck('image_path')->toArray(),
                'current_bid' => '',
                'time_remaining' => $auctionEndDate,
                'minimum_bid_amount' => '',
                'auction_type' => $product->auctionType->name,
                'auction_type_icon' => $auctionTypeIcon,
                'project_name' => $projectName,
                'project_state_date' => Carbon::parse($projectStartDate)->format('F j, h:i A'),
                'is_wishlist' => $loggedInUser ? $loggedInUser->wishlists->contains('product_id', $product->id) : false,

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
    public function addOrRemoveFromWishlist(Request $request)
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

        $wishlistItem = $user->wishlists()->where('product_id', $productId)->first();

        if ($wishlistItem) {
            // If the product is already in the wishlist, remove it
            $wishlistItem->delete();
            $message = 'Product removed from wishlist';
        } else {
            // If the product is not in the wishlist, add it
            $wishlist = new Wishlist();
            $wishlist->user_id = $user->id;
            $wishlist->product_id = $productId;
            $wishlist->save();
            $message = 'Product added to wishlist';
        }

        return response()->json([
            'ResponseCode' => 200,
            'Status' => 'true',
            'Message' => $message,
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
            $auctionType = AuctionType::find($product->auction_type_id);
            $now = Carbon::now();
            if ($auctionType && ($auctionType->name === 'Private' || $auctionType->name === 'Timed')) {
                $timestamp = strtotime($product->auction_end_date);
                $milliseconds = $timestamp * 1000;
                $auctionEndDate = $milliseconds;
            }
            $loggedInUser = Auth::user();
            $auctionType = AuctionType::find($product->auction_type_id);
            $auctionTypeName = $auctionType->name ?? null;
            $auctionTypeIcon = '';

            if ($auctionType && ($auctionType->name === 'Private')) {
                $auctionTypeIcon = asset('auctionicon/private_icon.png');
            } elseif ($auctionType && ($auctionType->name === 'Timed')) {
                $auctionTypeIcon = asset('auctionicon/time.png');
            } elseif ($auctionType && ($auctionType->name === 'Live')) {
                $auctionTypeIcon = asset('auctionicon/live.png');
            }

            // Add product details to the corresponding auction type key
            $formattedProducts[] = [
                'id' => $product->id,
                'lot_no' => $product->lot_no,
                'title' => $product->title,
                'image_path' => $product->galleries->first()->image_path,
                'reserved_price' => $product->reserved_price,
                'time_remaining' => $auctionEndDate,
                'current_bid' => '',
                'is_wishlist' => $loggedInUser ? $loggedInUser->wishlists->contains('product_id', $product->id) : false,
                'auction_type' => $auctionTypeName,
                'auction_type_icon' => $auctionTypeIcon,
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
                'user_id' => $userId, 
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

    // bid request

}
